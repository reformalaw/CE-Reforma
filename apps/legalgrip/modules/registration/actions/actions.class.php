<?php

/**
 * registration actions.
 *
 * @package    counceledge
 * @subpackage registration
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class registrationActions extends sfActions
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
     * Function to New Registration
     *
     * @param sfWebRequest $request
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new RegistrationForm();
    }

    /**
     * Function to Create Registration
     *
     * @param sfWebRequest $request
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->form = new RegistrationForm();
		$this->frmLogin = new LegalgripLoginForm();
		$this->processForm($request, $this->form);
        $this->setTemplate('login', 'auth');
    }

    /**
     * Function to Process Form of Registration
     *
     * @param sfWebRequest $request
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $users = $request->getParameter($form->getName());

        if ($form->isValid())
        {
			$form->getObject()->setBillingSubscription("No");
			$form->getObject()->setWebsiteSubscriotion("No");
			$form->getObject()->setNetworkProfileSubscription("No");
			$form->getObject()->setDefaultState("No");
			$form->getObject()->setUserType(sfConfig::get("app_UserType_User"));
			$form->getObject()->setStatus(sfConfig::get('app_UserStatus_Pending'));
			$form->getObject()->setActivationCode(clsCommon::getActivationKey(10));

			$users = $form->save();
			
			$arrParams = array();
			$arrParams['FirstName'] = $users->getFirstName()." ".$users->getLastName();
			$arrParams['toEmailAddress'] = $users->getEmail();
			$arrParams['ActivationKey'] = $users->getActivationCode();
			$arrParams['UserId'] = $users->getId();
			$objSiteMail = new siteMails();
			$objSiteMail->sendLegalgripRegistrationEmail($arrParams);

			$this->getUser()->setFlash('succMsg', "You are registerd successfully");
			$this->redirect('auth/login');

        }
    }
}