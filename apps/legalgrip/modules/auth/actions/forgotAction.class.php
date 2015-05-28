<?php
/**
 * forgotpassword action.
 *
 * @package    ValueCompass
 * @subpackage auth
 * @author
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class forgotAction extends sfAction
{
	/**
     * Function to execute an action
     *
     * @param sfWebRequest $request
     */
	public function execute($request){

		$this->form = new ForgotForm();
		$this->email = '';

		if($request->isMethod('post'))
		{
			$this->processForm($request, $this->form);
		}
		$this->setLayout('popup');

	}

	/**
     * Function to process for forget password
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if($form->isValid())
        {
			$forgotParam = $request->getParameter('forgot');
			$this->Email = trim($forgotParam['email']);
			$sql =	Doctrine_Query::CREATE()
					->select('u.Id, u.FirstName, u.LastName, u.Password')
					->from('Users u')
					->where("u.Email ='".$this->Email."'");
					$userDetails = $sql->fetchOne();
					$sql->free();
					
			if($userDetails)
			{
				if($userDetails->getStatus()== sfConfig::get('app_UserStatus_Active'))
				{
					$objPassEncDec = new encryptDecrypt(sfConfig::get('app_pwdEncDecKey'));
					$password = $objPassEncDec->decrypt($userDetails->getPassword());

					$arrParams = array();
					$arrParams['toEmailAddress'] = $this->Email;
					$arrParams['Password'] = $password;
					$arrParams['FirstName'] = $userDetails->getFirstName();
					$arrParams['LastName'] = $userDetails->getLastName();

					$objSiteMails = new siteMails();
					$objSiteMails->sendLegalgripForgotPasswordEmail($arrParams);

					$this->getUser()->setFlash("forgotSuccess",1);
				    $this->getUser()->setFlash("succMsg","Your password will be emailed to the registered email address entered",false);
				}
				else if($userDetails->getStatus()== sfConfig::get('app_UserStatus_Pending'))
				{
                    $activationCode = clsCommon::getActivationKey(10) ;
                    $result= Doctrine_Core::getTable('Users')->setUserActivationCode($userDetails->getId(),$activationCode);

					$arrParams = array();
					$arrParams['FirstName'] = $userDetails->getFirstName()." ".$userDetails->getLastName();;
					$arrParams['toEmailAddress'] = $this->Email;
					$arrParams['ActivationKey'] = $activationCode;
					$arrParams['UserId'] = $userDetails->getId();
					$objSiteMail = new siteMails();
					$objSiteMail->sendLegalgripRegistrationEmail($arrParams);

               	    $this->getUser()->setFlash('succMsg', "An activation email has been send to the email address you used to register.",false);
				}
				else if($userDetails->getStatus()== sfConfig::get('app_UserStatus_Inactive')|| $userDetails->getStatus()== sfConfig::get('app_UserStatus_Deleted'))
				{
					$this->getUser()->setFlash('errormsg', "Your Account is Inactive.",false);
				}
				$this->Email = '';
			}
			else 
			{
				$this->getUser()->setFlash("errormsg","This email id does not exist",false);
			}
		}
		else
		{
			$this->flashMessage['error'] = 'Validation Error';
		}
    }

	/**
     * Function to preExecute
     *
     */
	public function preExecute()
	{
		$this->flashMessage = array();
	}
}
