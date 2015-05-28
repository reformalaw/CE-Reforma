<?php

/**
 * administrators actions.
 *
 * @package    counceledge
 * @subpackage administrators
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class administratorsActions extends sfActions
{
    /**
    * HERE IN THIS FUNCTION WE ARE CHECKING THAT USER IS NOT ADMIN AND PERMISSION CHECK IS FALSE
    * THE REDIRECT TO THE NOT AUTHENTICATED PAGE.
    */
    public function preExecute()
    {
         if (clsCommon::permissionCheck($this->getModuleName()."/".$this->getActionName()) == false){
            $this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
            $this->redirect('default/index');
        }
    }
    public function executeIndex(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";
        $search_text = '';
        $isSearchBtn = '';
        $this->search_text = "";
        $this->field_type = "";
        $this->objSearchForm = new SearchAdminUsersForm();


        $qSearch = Doctrine_Query::create();
        $qSearch->from('Users us');
        $qSearch->where('us.Status != ?',"Deleted");
        $qSearch->where('us.UserType = ?',"Staff");

        if($request->isMethod('post')) {
            $isSearchBtn = $request->getPostParameter('search_btn');
            $this->search_text = trim($request->getPostParameter('search_admin_users[search_text]'));
            $this->field_type = $request->getPostParameter('search_admin_users[field_type]');
            if ('' != $this->field_type && '' != $this->search_text)
            {
                $qSearch->andWhere("us.$this->field_type LIKE '%".addslashes($this->search_text)."%'");
            }
        }

        $this->objSearchForm->setDefault('search_text', $this->search_text);
        $this->objSearchForm->setDefault('field_type', $this->field_type );

        switch($request->getParameter('orderBy'))
        {
            case "Name":
                $orderBy = 'FirstName';
                $this->orderBy = "Name";
                break;
            case "Email":
                $orderBy = 'Email';
                $this->orderBy = "Email";
                break;
            case "LastLoginDateTime":
                $orderBy = 'LastLoginDateTime';
                $this->orderBy = "LastLoginDateTime";
                break;
            case "CreateDateTime":
            default:
                $orderBy = 'CreateDateTime';
                $this->orderBy = "CreateDateTime";
                break;
        }

        switch($request->getParameter('orderType'))
        {
            case "asc":
                $qSearch->orderBy("$orderBy ASC");
                $this->orderType = "asc";
                break;
            case "desc":
            default:
                $qSearch->orderBy("$orderBy DESC");
                $this->orderType = "desc";
                break;
        }
        $pager = new sfDoctrinePager('Users', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    }
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new AdminUsersForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new AdminUsersForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($users = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), sprintf('Object users does not exist (%s).', $request->getParameter('id')));

        $this->form = new AdminUsersForm($users);
        
        $this->ssEmail = $users->getEmail();  // Staff Mail id
        $this->ssUserName = $users->getUsername(); // Staff username
        
        $arrCount = RolesTable::getAllRecord();
        $arrRoles = UserRolesTable::getRolesList($users->getId());
        if (count($arrRoles) == $arrCount) {
            $this->form->setDefault('selectAll',"");
        }
        $this->form->setDefault('Roles',$arrRoles);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($users = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), sprintf('Object users does not exist (%s).', $request->getParameter('id')));
        $this->ssEmail = $users->getEmail();    // Staff Mail id
        $this->ssUserName = $users->getUsername(); // Staff username

        $this->form = new AdminUsersForm($users);
        /* unset field on edit time */
        unset($this->form['Password']);
        unset($this->form['Email']);
        unset($this->form['Username']);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();

        $this->forward404Unless($users = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), sprintf('Object users does not exist (%s).', $request->getParameter('id')));
        $users->delete();

        $this->redirect('administrators/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $AdminUser = $request->getParameter($form->getName());
        //clsCommon::pr($user,1);
        if ($form->isValid())
        {
            $EmailCheck = 0;
            $EmailCheck = UsersTable::emailCheck($request->getParameter('id'),$AdminUser['Email']);
            $UserNameCheck = 0;
            $UserNameCheck = UsersTable::userNameCheck($request->getParameter('id'),$AdminUser['Username']);
            if ($EmailCheck == 0) {
                if ($UserNameCheck == 0) {
                    if ($request->isMethod(sfRequest::PUT)) {
                        $form->getObject()->setStatus($form->getObject()->getStatus());
                        $form->getObject()->setUserType($form->getObject()->getUserType());
                        $form->getObject()->setActivationCode('');
                        $users = $form->save();
                        if (!empty($AdminUser['Roles'])) {
                            UserRolesTable::deleteOldUserRoles($request->getParameter('id'));
                        	for ($i=0;$i<count($AdminUser['Roles']);$i++)
                            {
                                $objUserRoles = new UserRoles();
                                $objUserRoles->setUserId($users->getId());
                                $objUserRoles->setRoleId($AdminUser['Roles'][$i]);
                                $objUserRoles->save();
                            }
                        }
                    }else {
                        $form->getObject()->setStatus(sfConfig::get('app_UserStatus_Pending'));
                        $form->getObject()->setUserType(sfConfig::get('app_UserType_Staff'));
                        $form->getObject()->setActivationCode(clsCommon::getActivationKey(10));
                        $users = $form->save();
                        if (!empty($AdminUser['Roles'])) {
                            for ($i=0;$i<count($AdminUser['Roles']);$i++)
                            {
                                $objUserRoles = new UserRoles();
                                $objUserRoles->setUserId($users->getId());
                                $objUserRoles->setRoleId($AdminUser['Roles'][$i]);
                                $objUserRoles->save();
                            }
                        }

                        // Sending Activation email
                        $arrParams = array();
                        $arrParams['FirstName'] = $users->getFirstName()." ".$users->getLastName();
                        $arrParams['toEmailAddress'] = $users->getEmail();
                        $arrParams['ActivationKey'] = $users->getActivationCode();
                        $arrParams['UserId'] = $users->getId();
                        $objSiteMail = new siteMails();
                        $objSiteMail->sendRegistrationEmail($arrParams);
                    }
                }else {
                    $this->getUser()->setFlash('errMsg', "User name is already in use.");
                    $this->redirect('administrators/edit?id='.$request->getParameter('id'));
                }
            }else {
                $this->getUser()->setFlash('errMsg', "E-mail address is already in use.");
                $this->redirect('administrators/edit?id='.$request->getParameter('id'));
            }
            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "New staff added successfully");

            $this->redirect('administrators/index');
            //$this->redirect('administrators/edit?id='.$users->getId());
        }
    }

    Public function executeVerifyAccount(sfWebRequest $request){
        //COMMENT : CHECK FOR ID & ACTIVATION KEY IN THE PARAMETER IF NOT SEND USE TO REGISTER PAGE
        $this->forward404Unless($request->getParameter('id'));
        $this->forward404Unless($request->getParameter('actKey'));

        //COMMENT: FIND THE USER DETAIL
        $objUsers = Doctrine_Core::getTable('Users')->find($request->getParameter('id'));

        //COMMENT : IF USESR FOUND THEN PROCESS THE ACTIVATION OF ACCCOUNT
        if($objUsers)   	{
            //COMMENT : CHECK USERS CURRENT STATUS IS PENDING FOR REVIEW
            if($objUsers->getStatus()== sfConfig::get('app_UserStatus_Pending'))   {

                //COMMENT : ACTIVATION KEY VALIDAITON
                if($objUsers->getActivationCode()==$request->getParameter('actKey'))   {
                    //COMMENT : ACTIAVE THE USER & SET SUCESS MESSAGE
                    $objUsers->setStatus(sfConfig::get('app_UserStatus_Active'));
                    $objUsers->setActivationCode('');
                    $objUsers->save();

                    // Sending Welcome email
                    $objPassEncDec = new encryptDecrypt(sfConfig::get('app_pwdEncDecKey'));
                    $password = $objPassEncDec->decrypt($objUsers->getPassword());

                    $arrParams = array();
                    $arrParams['FirstName'] = $objUsers->getFirstName().' '.$objUsers->getLastName();
                    $arrParams['toEmailAddress'] = $objUsers->getEmail();
                    $arrParams['Password'] = $password;
                    $arrParams['UserId'] = $objUsers->getId();
                    $objSiteMail = new siteMails();
                    $objSiteMail->sendWelcomeEmail($arrParams);

                    $this->getUser()->setFlash('success', "Your account has been successfully activated. Please login.");
                    $this->redirect('auth/login');
                    //$this->redirect('default/index');
                }
                //COMMENT : INVALID ACTIVATION KEY THROW ERROR
                else
                {
                    #$this->errMsg = 'Invalid activation key. Please check your activation key and try again.';
                    $this->getUser()->setFlash('error', "Invalid activation key. Please check your activation key and try again.");
                }
            }
            //COMMENT : IF USER STATUS IS ACTIVE ALLREADY THROW ERROR
            else
            {
                #$this->errMsg = "Your account has been already activated. Please contact system administrator if you are not able to login to the system";
                $this->getUser()->setFlash('error', "Your account has already been activated. Please contact the system administrator if you are unable to login to the system.");

            }
        }
        //COMMENT : IF USER NOT FOUND THROW ERROR
        else
        {
            #$this->errMsg = "Invalid activation link. Please check your activation URL and try again.";
            $this->getUser()->setFlash('error', "Invalid activation link. Please check your activation URL and try again.");
        }
        $this->redirect('auth/login');
    }

    /* Change Status Action*/
    Public function executeChangeStatus(sfWebRequest $request)
    {
        $this->forward404Unless($users = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), sprintf('User not found!'));
        $status = $request->getParameter('status');
        // Do not allow to change status of current user
        if($request->getParameter('id') == $this->getUser()->getAttribute("admin_user_id")){
            $this->getUser()->setFlash("errMsg","Status cannot be changed.");
        }else if (in_array($status,array('Active','Inactive'))){
            /**
             *  Here is set the satus of User i.e. active or inactive.
             */
            /*echo $status;die;*/
            $users->setStatus($status);
            $users->setUpdateDateTime(date("Y-m-d H:i:s"));
            $users->save();
            $arrParams = array();
            //if ($request->getParameter('tempval') == "userStatus") {
            if($status=="Active"){
                $this->getUser()->setFlash("succMsg",'Status successfully changed to active.');
                $arrParams['Status'] = 'Active';
            }else{
                $this->getUser()->setFlash("succMsg",'Status successfully changed to inactive.');
                $arrParams['Status'] = 'Inactive';
            }
            //}

            // SEND NOTIFICATION EMAIL TO USER START
            $arrParams['toEmailAddress'] = $users->getEmail();
            $arrParams['FirstName'] = ucfirst(strtolower($users->getFirstName()));
            //COMMENT : GET THE OBJECT OF MAIL CLASS
            $objSiteMails = new siteMails();
            //COMMENT : CALL TO SENDSTATUSCHANGE EMAIL MEHTOD OF MAIL CLASS
            $objSiteMails->sendStatusChangeEmail($arrParams);

            // SEND NOTIFICATION EMAIL TO USER END
        }
    
        if($request->getParameter('flag'))
            $this->redirect('administrators/view?id='.$request->getParameter('id'));

        $this->redirect('administrators/index');
        
    }
    
    public function executeView(sfWebRequest $request)
    {
        $this->forward404Unless($this->users = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), 'Administrator does not exist.');
    }
    
    public function executeAjaxDefaultImage(sfWEbRequest $request)
    {
		if ($request->isXmlHttpRequest())
		{
			if($request->isMethod('post'))
			{
				$userId = $request->getParameter('id');
				
				$userObject = Doctrine::getTable('Users')->find(array($userId));
				$oldFile = $userObject->getProfilePic();
				
				$oUsers = new Users();
				$oUsers->setUserProfileImage($userId);
				
				$profilepicPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."userpic".DIRECTORY_SEPARATOR.$userId.DIRECTORY_SEPARATOR;
				$unlink_media = @unlink($profilepicPath.sfConfig::get("app_Prefix_Org").$oldFile);
				$unlink_media = @unlink($profilepicPath.sfConfig::get("app_Prefix_Thumb").$oldFile);
				$unlink_media = @unlink($profilepicPath.sfConfig::get("app_Prefix_Small").$oldFile);
				$unlink_media = @unlink($profilepicPath.sfConfig::get("app_Prefix_Large").$oldFile);
				$unlink_media = @unlink($profilepicPath.sfConfig::get("app_Prefix_Medium").$oldFile);
			}
		}
		exit;
    }
}
