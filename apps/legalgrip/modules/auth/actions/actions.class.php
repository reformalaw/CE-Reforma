<?php

/**
 * auth actions.
 *
 * @package    counceledge
 * @subpackage auth
 * @author     Your name here
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
		$this->forward('default', 'module');
	}

	/**
	 * Executes Login action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeLogin(sfWebRequest $request)
	{
		$this->redirectIf($this->getUser()->isAuthenticated() ,'default/index');
		$this->frmLogin = new LegalgripLoginForm();
		$this->form = new RegistrationForm();
		
		if($request->hasParameter('flag'))
		{
			if($request->getParameter('flag') != "")
			{
				$previousUrl = $this->getContext()->getRequest()->getReferer();
				$this->getUser()->setAttribute('referer', $previousUrl);
				$this->getUser()->setAttribute('redirectReferer', $request->getParameter('flag'));
			}
		}

		/*if($request->isMethod('post'))
		{
			$userinfo = $request->getParameter('login');
			$this->form->bind($request->getParameter('login'));

			if ($this->form->isValid())
			{
				$username=trim($userinfo['email']);
				$password=trim($userinfo['password']);
				$result = Doctrine_Core::getTable('Users')->getUserDetailsByEmail($username);

				if($result)
				{
					$objPassEncDec = new encryptDecrypt(sfConfig::get('app_pwdEncDecKey'));
					$dbPassword = $objPassEncDec->decrypt($result['Password']);

					if($dbPassword == $password)
					{
						if($result['Status'] == sfConfig::get('app_UserStatus_Active') && ($result['UserType'] == sfConfig::get('app_UserType_User')))
						{
							$this->getUser()->setAuthenticated(true);
							$this->getUser()->setAttribute('user_user_id', $result['Id']);

							if(array_key_exists('remember',$userinfo) && $userinfo['remember'])
							{
								RememberMe::setRemember($username,$password,true,true);
							}else{
								RememberMe::removeRemember(true);
							}
							$redirectValue = $result->getLastLoginDateTime();
							UsersTable::updateLastLoginDate($result['Id']);
							$this->getUser()->setFlash('succMsg', "Welcom to user pannel.");
							
							//when user first time login redirect to profile
							if($redirectValue == "")
								$this->redirect("registration/myprofile");

							$this->redirect("default/index");
						}
						else
						{
							$this->getUser()->setAuthenticated(false);
							$this->getUser()->setFlash('errorMessage', "Sorry, you are not authorized to access user pannel.",false);
						}
					}
					else{
						$this->getUser()->setAuthenticated(false);
						$this->getUser()->setFlash('errorMessage','Invalid authentication details provided.',false);
					}
				}
				else
				{
					$this->getUser()->setAuthenticated(false);
					$this->getUser()->setFlash('errorMessage','Invalid authentication details provided.',false);
				}
			}
		} */
	}
	public function executeCreateLogin(sfWebRequest $request)
	{
		$this->redirectIf($this->getUser()->isAuthenticated() && ($this->getUser()->hasCredential('user')),'default/index');
		$this->redirectIf($this->getUser()->isAuthenticated() && ($this->getUser()->hasCredential('user')),'default/index');
		$this->frmLogin = new LegalgripLoginForm();
		$this->form = new RegistrationForm();
		$this->processForm($request, $this->frmLogin);
		$this->setTemplate('login');
	}
	protected function processForm(sfWebRequest $request, sfForm $frmLogin)
	{
		$redirectValue = "";
		if($request->isMethod('post'))
		{
			$userinfo = $request->getParameter('login');
			$this->frmLogin->bind($request->getParameter('login'));

			if ($this->frmLogin->isValid())
			{
				$username=trim($userinfo['email']);
				$password=trim($userinfo['password']);
				$result = Doctrine_Core::getTable('Users')->getUserDetailsByEmail($username);

				if($result)
				{
					$objPassEncDec = new encryptDecrypt(sfConfig::get('app_pwdEncDecKey'));
					$dbPassword = $objPassEncDec->decrypt($result['Password']);

					if($dbPassword == $password)
					{
						if($result['Status'] == sfConfig::get('app_UserStatus_Active') && ($result['UserType'] == sfConfig::get('app_UserType_User')))
						{
							$this->getUser()->setAuthenticated(true);
							$this->getUser()->setAttribute('user_user_id', $result['Id']);
							$this->getUser()->setAttribute('user_firstname', $result['FirstName']);
    						$this->getUser()->setAttribute('user_lastname', $result['LastName']);
    						$this->getUser()->setAttribute('user_email', $result['Email']);

							if(array_key_exists('remember',$userinfo) && $userinfo['remember'])
							{
								RememberMe::setRemember($username,$password,true,true);
							}else{
								RememberMe::removeRemember(true);
							}
							$redirectValue = $result->getLastLoginDateTime();
							UsersTable::updateLastLoginDate($result['Id']);
							//$this->getUser()->setFlash('succMsg', "Welcom to user pannel.");
							
							//when user first time login redirect to profile
							if($redirectValue == "")
								$this->redirect("registration/myprofile");

							
							if($this->getUser()->getAttribute('redirectReferer') == "referer")
							{
								$priviousRedirect = $this->getUser()->getAttribute('referer');

								//$this->getUser()->getAttributeHolder()->remove('referer');
								$this->getUser()->getAttributeHolder()->remove('redirectReferer');

								$this->getUser()->setFlash('ratingMsg', "You already given rating",true);
								$this->redirect($priviousRedirect);
								//$this->redirect($priviousRedirect."?popupOpen=popupOpen");
							}
							 
							$this->redirect("default/index");
						}
						else
						{
							$this->getUser()->setAuthenticated(false);
							$this->getUser()->setFlash('errorMessage', "Sorry, you are not authorized to access user pannel.");
							$this->redirect("auth/login");
						}
					}
					else{
						$this->getUser()->setAuthenticated(false);
						$this->getUser()->setFlash('errorMessage','Invalid authentication details provided.');
						$this->redirect("auth/login");
					}
				}
				else
				{
					$this->getUser()->setAuthenticated(false);
					$this->getUser()->setFlash('errorMessage','Invalid authentication details provided.');
					$this->redirect("auth/login");
				}
			}
			else
				$this->redirect("auth/login");
		}
		else
			$this->redirect("auth/login");
	}
	/**
	 * Executes logout action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeLogout(sfWebRequest $request)
	{
		$this->getUser()->setAuthenticated(false);
		$this->getUser()->getAttributeHolder()->clear();
		$this->getUser()->clearCredentials();
		RememberMe::removeRemember(true);
        $this->redirect('auth/login');
    }

    /**
	 * Executes verifyaccount action
	 *
	 * @param sfRequest $request A request object
	 */
	Public function executeVerifyAccount(sfWebRequest $request)
	{
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
                    $objSiteMail->sendLegalgripWelcomeEmail($arrParams);

                    $this->getUser()->setFlash('succMsg', "Your account has been successfully activated. Please login.");
                    $this->redirect('auth/login');
                    //$this->redirect('default/index');
                }
                //COMMENT : INVALID ACTIVATION KEY THROW ERROR
                else
                {
                    $this->getUser()->setFlash('errMsg', "Invalid activation key. Please check your activation key and try again.");
                }
            }
            //COMMENT : IF USER STATUS IS ACTIVE ALLREADY THROW ERROR
            else
            {
                $this->getUser()->setFlash('errMsg', "Your account has been already activated. Please contact system administrator if you are not able to login to the system");

            }
        }
        //COMMENT : IF USER NOT FOUND THROW ERROR
        else
        {
            $this->getUser()->setFlash('errMsg', "Invalid activation link. Please check your activation URL and try again.");
        }
        $this->redirect('auth/login');
    }
}
