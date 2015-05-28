<?php

class contactusActions extends sfActions
{
    /*public function preExecute()
    {
        StatisticsTable::addIpToStatistics($this->getRequest()->getRemoteAddress(),$this->getContext()->getRequest()->getHost());
    }*/
    public function executeIndex(sfWebRequest $request)
    {
        $this->contactForm = new ContactUsForm();

        // SETTING PAGE TITLE,KEYWORDS & DESCRIPTIONS.
        $this->getResponse()->setTitle('Conceledge :: Contact Us');
        $this->getResponse()->addMeta('title','contact us meta title');
        $this->getResponse()->addMeta('keywords','Contact us meta keywords');
        $this->getResponse()->addMeta('description','this is meta description for contact us page.');
        
        //COMMENT : CHECK IF FORM IS POSTED & IF POSTED PROCESS IT
        if($request->isMethod('POST')){
            $this->processForm($request, $this->contactForm);
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form){
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $contact = $request->getParameter($form->getName());
        if($form->isValid()){
            $arrParams = array();
            $arrParams['Name'] = $contact['name'];
            $arrParams['toEmailAddress'] = trim($contact['email']);
            if ((in_array($contact['preferredEmail'],$contact)) && !empty($contact['preferredEmail'])) {
                $arrParams['preferredEmail'] = $contact['preferredEmail'];
            }
            $arrParams['Phone'] = trim($contact['phone']);
            if ((in_array($contact['preferredPhone'],$contact)) && !empty($contact['preferredPhone'])) {
                $arrParams['preferredPhone'] = $contact['preferredPhone'];
            }
            $arrParams['Note'] = $contact['note'];
            //COMMENT : GET THE OBJECT OF MAIL CLASS
            $objSiteMails = new siteMails();

            //COMMENT : CALL TO CONTACT US MAIL MEHTOD OF MAIL CLASS
            $objSiteMails->sendUserContactUsEmail($arrParams);

            $this->getUser()->setFlash("succMsg","Your Request is sent to Site Admin");
            $this->redirect('contactus/index');
        }
    }
}
