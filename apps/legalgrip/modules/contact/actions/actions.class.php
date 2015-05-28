<?php

/**
 * contact actions.
 *
 * @package    counceledge
 * @subpackage contact
 * @author     Chintan Fadia
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contactActions extends sfActions
{
    /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {

        $userId = $request->getParameter('id');
        $this->userData = Doctrine::getTable('Users')->find(array($userId));
        $this->UserId = $userId;

        $customForm = false;
        $defaultform = false ;

        // Check if Users Own
        $customerDatas = AttorneyContactTable::getCustomers($userId);
        if(!empty($customerDatas)) {
            $this->customerDatas = AttorneyContactTable::getCustomers($userId);
            $this->form = new AttorneyContactForm(null, array('userId' => $userId));
            $customForm = true;
        } else {

            //COMMENT : DEFAULT CONTACT US PAGE FOR USERS
            $this->form = new LGDefaultContactForm();
            #$this->form->setDefault('message','Message');
            $defaultform = true ;
        }

        $this->customForm = $customForm ;
        $this->defaultform = $defaultform;
    }

    /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeCreate(sfWebRequest $request)
    {

        $userId = $request->getParameter('id');
        $this->userData = Doctrine::getTable('Users')->find(array($userId));
        $this->UserId = $userId;

        $customForm = false;
        $defaultform = false ;

        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $customerDatas = AttorneyContactTable::getCustomers($userId);
        if(!empty($customerDatas)) {
            $this->customerDatas = AttorneyContactTable::getCustomers($userId);
            $this->form = new AttorneyContactForm(null, array('userId' => $userId));
            $customForm = true;
            $this->processForm($request, $this->form);
        } else {

            //COMMENT : DEFAULT CONTACT US PAGE FOR USERS
            $this->form = new LGDefaultContactForm();
            #$this->form->setDefault('message','Message');
            $this->processDefaultForm($request, $this->form);
            $defaultform = true ;
        }

        $this->customForm = $customForm ;
        $this->defaultform = $defaultform;

        $this->setTemplate('index');

    } // End of Function


    /**
     * Function to Dynamic Process Form for Attorney Custom Contact Form 
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {

        $userId = $request->getParameter('id');
        $customerDatas = AttorneyContactTable::getCustomers($userId);
        $userData = Doctrine::getTable('Users')->find(array($userId));

        $attachment = array();

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid())
        {
            $formFileData = $request->getFiles($form->getName());
            $formData = $request->getParameter($form->getName());
            $mailDatas = array();

            foreach($customerDatas as $customerData)
            {
                if($customerData["FieldType"] == "FileUpload")
                {
                    /*$fileInfo = $formFileData["input_".$customerData["Id"]."_".$userId];
                    $mailDatas[$customerData["Label"]] = $fileInfo["name"];
                    $attachPath = $this->fileUploads($WebsiteId,$formFileData["input_".$customerData["Id"]."_".$userId]);
                    $attachment[] = $attachPath;*/
                }
                else
                {
                    if($customerData["FieldType"] == "CheckBox")
                    {
                        $checBoxValues = $formData["input_".$customerData["Id"]."_".$userId];
                        $checBoxData = "";

                        $newArray = explode(',',$customerData['Options']);
                        $slugArray = explode(',',$customerData['OptionsSlug']);
                        $combinArr = array_combine($slugArray, $newArray);

                        foreach($checBoxValues as $checBoxValue)
                        {
                            #$checBoxData.= $checBoxValue.",";
                            $checBoxData.= $combinArr[$checBoxValue].",";
                        }
                        $checBoxData = substr_replace($checBoxData ,"",-1);
                        $mailDatas[$customerData["Label"]] = $checBoxData;
                    }

                    else if($customerData["FieldType"] == "Radio")
                    {

                        $newArray = explode(',',$customerData['Options']);
                        $slugArray = explode(',',$customerData['OptionsSlug']);
                        $combinArr = array_combine($slugArray, $newArray);
                        $mailDatas[$customerData["Label"]] = $combinArr[$formData["input_".$customerData["Id"]."_".$userId]];
                    }
                    else if ($customerData["FieldType"] == "Captcha") {}
                    else
                    {
                        $mailDatas[$customerData["Label"]] = $formData["input_".$customerData["Id"]."_".$userId];
                    }
                }
            }

            $mailTable = '';
            foreach($mailDatas as $key => $mailData)             {
                $mailTable.= "<p><strong>".$key.": </strong>".$mailData."</p>";
            }


            $siteOwenerInfo = array();
            $siteOwenerInfo['UserName'] = $userData->getFirstName()." ".$userData->getLastName();
            $siteOwenerInfo['UserEmail'] = $userData->getEmail();

            $objSiteMails = new siteMails();
            $objSiteMails->sendAttorneyContactUsEmail($mailTable, $siteOwenerInfo,$attachment);
            $this->getUser()->setFlash('succMsg', "Your Request is sent to Attorney",false);

            /*foreach($attachment as $fileAttach)
            {
            $unlinkAttach = @unlink($fileAttach);
            }*/

            #$this->redirect('contact/index?id='.$userId);

            // Add To Attorney Statistics By Contact
            AttorneyStatisticsTable::addToStatisticsByContact($this->getRequest()->getRemoteAddress(), $userId);
        }
    } // End of Function


    /**
     * Function to Dynamic Process Form for Attorney Custom Contact Form 
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    protected function processDefaultForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $contact = $request->getParameter($form->getName());

        if ($form->isValid())         {
            $userId = $request->getParameter('id');
            $userData = Doctrine::getTable('Users')->find(array($userId));

            //COMMENT : RECEIVED INFORMATION
            $arrParams = array();
            $arrParams['Name'] = trim($contact['name']);
            $arrParams['Email'] = trim($contact['email']);
            $arrParams['Phone'] = trim($contact['phone']);
            $arrParams['Message'] = trim($contact['message']);

            $mailTable = '';
            foreach($arrParams as $key => $val)             {
                $mailTable.= "<p><strong>".$key.": </strong>".$val."</p>";
            }

            $siteOwenerInfo = array();
            $siteOwenerInfo['UserName'] = $userData->getFirstName()." ".$userData->getLastName();
            $siteOwenerInfo['UserEmail'] = $userData->getEmail();

            $objSiteMails = new siteMails();
            $objSiteMails->sendAttorneyContactUsEmail($mailTable, $siteOwenerInfo,$attachment = array());
            $this->getUser()->setFlash('succMsg', "Your Request is sent to Attorney",false);

            // Add To Attorney Statistics By Contact
            AttorneyStatisticsTable::addToStatisticsByContact($this->getRequest()->getRemoteAddress(), $userId);

        } // End of IF
    } // End of Function

    /**
     * Function to contactus information add
     *
     * @param sfWebRequest $request
     */
    public function executeContactus(sfWebRequest $request)
    {
        $this->form = new LGContactusForm();
    }

    /**
     * Function to fill the contact us information 
     *
     * @param sfWebRequest $request
     */
    public function executeContactusCreate(sfWebRequest $request)
    {
        $this->form = new LGContactusForm();
        $this->processContactusForm($request, $this->form);
        $this->setTemplate('contactus');
    }

    /**
     * Function to  Process Form for contact us form
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    protected function processContactusForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $contactus = $request->getParameter($form->getName());

        if ($form->isValid())         {

            $arrParams = array();
            $arrParams['Name'] = trim($contactus['name']);
            $arrParams['Email'] = trim($contactus['email']);
            $arrParams['Phone'] = trim($contactus['phone']);
            $arrParams['Message'] = trim($contactus['message']);

            $objSiteMails = new siteMails();
            $objSiteMails->sendLegalgripAdminContactusEmail($arrParams);
            $this->getUser()->setFlash('succMsg', "Your message is sent to Legal Grip Admin");

            $this->redirect("contact/contactus");
        }
    }

}