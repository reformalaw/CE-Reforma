<?php

/**
 * auth actions.
 *
 * @package    Luckzy
 * @subpackage auth
 * @author     Bhavik Shah <bhavikshah@greymatterindia.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class authActions extends sfActions
{

    /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {
        $objPassEncDec = new encryptDecrypt(sfConfig::get('app_pwdEncDecKey'));
        $this->redirect('auth/login');
    }

    public function executeLogin(sfWebRequest $request){

		if($request->hasParameter("from") && $request->getParameter("from") == "editemail"){
			$this->getUser()->setFlash('succMsg','Your e-mail has been updated successfully. You may now login with your new e-mail.');
		}
		
		// Start when password change message display change by jaydip
		if($request->hasParameter("from") && $request->getParameter("from") == "myprofile"){
			$this->getUser()->setFlash('succMsg','Your password has been changed successfully. You may now login with your new password.',false);
		}
		// END when password change message display change by jaydip
		
        $this->redirectIf($this->getUser()->isAuthenticated() && ($this->getUser()->hasCredential('admin') || $this->getUser()->hasCredential('staff') || $this->getUser()->hasCredential('customer')),'default/index');
        RememberMe::autoLogin(true); ##CHECK AND SET AUTOLOGIN OF USER
        $this->redirectIf($this->getUser()->isAuthenticated() && ($this->getUser()->hasCredential('admin') || $this->getUser()->hasCredential('staff') || $this->getUser()->hasCredential('customer')),'default/index');

        $this->form = new AdminLoginForm();

        if($request->isMethod('post')){

            $userinfo = $request->getParameter('login');

            $this->form->bind($request->getParameter('login'));

            if ($this->form->isValid()) {

                $username=trim($userinfo['email']);
                $password=trim($userinfo['password']);


                //$result =  UsersTable::getUserDetailsByEmail($username);

                $result = Doctrine_Core::getTable('Users')->getUserDetailsByEmail($username);

                // Check user exist
                if($result)
                {

                    $objPassEncDec = new encryptDecrypt(sfConfig::get('app_pwdEncDecKey'));
                    $dbPassword = $objPassEncDec->decrypt($result['Password']);

                    // Check if password is valid
                    if($dbPassword == $password)
                    {
                        // Check if status is active
                        if($result['Status'] == sfConfig::get('app_UserStatus_Active') && ($result['UserType'] == sfConfig::get('app_UserType_Admin') ||
                        $result['UserType'] == sfConfig::get('app_UserType_Staff') ||
                        $result['UserType'] == sfConfig::get('app_UserType_Customer') ))
                        {
                            // Set session for user
                            $this->getUser()->setAuthenticated(true);
                            $this->getUser()->setAttribute('admin_user_id', $result['Id']);
                            $this->getUser()->setAttribute('admin_email', $result['Email']);
                            $this->getUser()->setAttribute('admin_firstname', $result['FirstName']);
                            $this->getUser()->setAttribute('admin_lastname', $result['LastName']);
                            $this->getUser()->setAttribute('user_type', $result['UserType']);
                            
                            # HERE WE ARE GETTING THE STAFF PEMISSION FOR LOGIN USERS AND STORE THAT ARRAY IN SESSION.
                            //if ($result['UserType'] != sfConfig::get('app_UserType_Admin')){
                            /*if ($result['UserType'] == sfConfig::get('app_UserType_Staff')){
                                $arrPermission = UserRolesTable::getPermissionListUsingRole($result['Id']);
                                // Set session for user
                                $this->getUser()->setAttribute('staff_permission', $arrPermission);
                            }*/

                            if ($result['UserType'] == sfConfig::get('app_UserType_Admin') ){
                                $this->getUser()->addCredential('admin');
                            }elseif($result['UserType'] == sfConfig::get('app_UserType_Staff')){
                                $this->getUser()->addCredential('staff');
                            }
                            elseif($result['UserType'] ==  sfConfig::get('app_UserType_Customer') ){
                                $this->getUser()->addCredential('customer');

								/* create session for newtworkProfileSubscription is yes or no */
								if($result["NetworkProfileSubscription"] == "Yes")
									$this->getUser()->setAttribute('NetworkProfileSubscription',"Yes");
								else
									$this->getUser()->setAttribute('NetworkProfileSubscription',"No");

								/* create session for billingSucscription is yes or no */
								if($result['BillingSubscription'] == "Yes")
									$this->getUser()->setAttribute('billingSucscription',"Yes");
								else
									$this->getUser()->setAttribute('billingSucscription',"No");

								/* create session for WebsiteSubscriotion is yes or no */
								if($result["WebsiteSubscriotion"] == "Yes")
									$this->getUser()->setAttribute('WebsiteSubscriotion',"Yes");
								else
									$this->getUser()->setAttribute('WebsiteSubscriotion',"No");


								/* this if is for personal website take into session */
                                if($result['WebsiteSubscriotion'] == "Yes")
                                {
                                    $oUsersWebsite = new UsersWebsite();
                                    $userData = $oUsersWebsite->getUsersWebsiteId($result['Id']);
                                    $this->getUser()->setAttribute('personalWebsiteId',$userData[0]["Id"]);
                                    $this->getUser()->setAttribute('websiteUrl',$userData[0]["Websiteurl"]);
                                }

                            }
                            else{}

                            if(array_key_exists('remember',$userinfo) && $userinfo['remember']) {
                                RememberMe::setRemember($username,$password,true,true); ## SET AUTOLOGIN OF ADMIN
                            }else{
                                RememberMe::removeRemember(true); ##REMOVE AUTOLOGIN
                            }

                            // FRONTEND LOGING - START
                            //$this->getUser()->setAttribute('userId', $result['Id']);
                            //$this->getUser()->setAttribute('userEmail', $result['Email']);
                            //$this->getUser()->setAttribute('userFirstname', $result['FirstName']);
                            //$this->getUser()->setAttribute('userLastname', $result['LastName']);
                            // FRONTEND LOGING - END
                            ///REDIRECT
                            UsersTable::updateLastLoginDate($result['Id']);
                            $this->redirect("default/index");
                            /*if($this->getRequest()->getReferer()!='' && !strstr($this->getRequest()->getReferer(),'auth')){
                            $this->redirect($this->getRequest()->getReferer());
                            }else{
                            $this->redirect("default/index");
                            }*/
                        }
                        else {
                            $this->mail = $username;     // if validation fires
                            $this->getUser()->setAuthenticated(false);
                            $this->getUser()->setFlash('errorMessage', "Sorry, you are not authorized to access the admin control panel.");
                        }
                    }
                    else{
                        $this->mail = $username;     // if validation fires
                        $this->getUser()->setAuthenticated(false);
                        $this->getUser()->setFlash('errorMessage','Your account cannot be verified.  Please check your credentials and try again.');
                    }
                }
                else
                {
                    $this->mail = $username;     // if validation fires
                    $this->getUser()->setAuthenticated(false);
                    $this->getUser()->setFlash('errorMessage','Your account cannot be verified.  Please check your credentials and try again.');
                }
            }
            
            $this->mail = trim($userinfo['email']);// if validation fires
        }
    }


    public function executeLogout(sfWebRequest $request){

		// when edit email at that time set message
		
        $this->getUser()->setAuthenticated(false);
        $this->getUser()->getAttributeHolder()->clear();
        $this->getUser()->clearCredentials();
        RememberMe::removeRemember(true);

        if($request->hasParameter("from") && $request->getParameter("from") == "editemail")
		{
			sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));
			$this->redirect('auth/login?1&from=editemail');
		}
		
		// Start when password change parameter set change by jaydip
		if($request->hasParameter("from") && $request->getParameter("from") == "myprofile")
		{
			sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));
			$this->redirect('auth/login?1&from=myprofile');
		}
		// END when password change parameter set change by jaydip
		
        $this->redirect('auth/login');
    }

}
