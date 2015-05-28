<?php
/**
 * change Email actions.
 *
 * @package    my profile
 */
class changeEmailAction extends sfActions
{
	/**
     * Function to change Email
     *
     * @param sfWebRequest $request
     */
    public function executeChangeEmail(sfWebRequest $request)
    {
        $this->snId = $this->getUser()->getAttribute('admin_user_id');
        $this->forward404Unless($users = Doctrine::getTable('Users')->find(array($this->snId)), sprintf('Object users does not exist (%s).', $this->snId));
        $this->ssEmail = $users->getEmail();
        $this->form = new ChangeEmailForm();

        if($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
        {
            $this->processForm($request, $this->form, $users->getPassword(),$users,$this->ssEmail);
        }
    }

    /**
     * Function to process the edit time
     *
     * @param sfWebRequest $request
     * @param sfForm       $form
     * @param string       $dbPassword
     */
    protected function processForm(sfWebRequest $request, sfForm $form, $dbPassword,$users,$oldEmail)
    {
        $id = $this->getUser()->getAttribute('admin_user_id');
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $user = $request->getParameter($form->getName());
        $formPassword = $request->getPostParameter('changeEmail[Password]');

        /* db old password encryption */
        $objPassEncDec = new encryptDecrypt(sfConfig::get('app_pwdEncDecKey'));
        $Password = $objPassEncDec->decrypt($dbPassword);
		$allEmails = UsersTable::allEmailId();
		foreach($allEmails as $email)
		{
			$allEmail[] = $email["Email"];
		}

        if ($form->isValid())
        {
			if($oldEmail == $user["Email"])
            {
				$this->getUser()->setFlash('errMsg','Current and new email are the same.  Please try again.');
                 return sfView::ERROR;
            }

			if(in_array($user["Email"], $allEmail))
			{
				$this->getUser()->setFlash('errMsg','The e-mail you entered is already in use.  Please try again.');
                 return sfView::ERROR;
			}
			
            if($Password != $formPassword)
            {
                 $this->getUser()->setFlash('errMsgPassword','Password is incorrect.  Please try again.');
                 return sfView::ERROR;
            }
            else
            {
				/*update query to update the email */
				$oUsers = new Users();
				$oUsers->changeEmail($id,trim($user["Email"]));

				/*Email goes to user */
				$oSiteMails = new siteMails();
				$oSiteMails->sendChangeEmailAddress($user["Email"],$users);

				/*Email goes to Admin */
				$oSiteMails = new siteMails();
				$oSiteMails->changeEmailNotificationToAdmin($user["Email"],$oldEmail, $users);

				//$users = $form->save();
				
				$this->redirect('auth/logout?from=editemail');
            }
    }
  }
}
?>