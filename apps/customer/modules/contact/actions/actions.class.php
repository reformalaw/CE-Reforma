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

    public function preExecute()
    {

        // Set Title
        $pageTitle = ucfirst($this->context->get('UserFirstName')).' '.ucfirst($this->context->get('UserLastName'));
        $this->getResponse()->setTitle($pageTitle.' - Attorneys At Law');

        $WebsiteId=$this->context->get('WebsiteId');
        $ThemeId=$this->context->get('ThemeId');

        $arrAssetsDefault = sfConfig::get('app_theme'.$ThemeId.'_default');
        $arrAssetsHome = sfConfig::get('app_theme'.$ThemeId.'_home');

        $this->setLayout('theme'.$ThemeId.'/default');

        foreach ($arrAssetsDefault as $key=>$value1){
            if($key=='css'){
                foreach ($value1 as $index=>$value2) {
                    $this->getResponse()->addStylesheet('theme'.$ThemeId.'/'.$value2);
                }
            }
            if($key=='js'){
                foreach ($value1 as $index=>$value2) {
                    $this->getResponse()->addJavascript('theme'.$ThemeId.'/'.$value2);
                }
            }
        }

    } // End of Function


    /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {
        $WebsiteId=$this->context->get('WebsiteId');
        $UserId=$this->context->get('UserId');
        $this->UserId = $UserId;
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

        $this->customerDatas = CustomerContactTable::getCustomers($UserId);

        if(!empty($this->customerDatas))
        $this->form = new CustomerContactForm(null, array('userId' => $UserId));
        else
        $this->form = "";


    } // End of Function

    /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeCreate(sfWebRequest $request)
    {
        $WebsiteId=$this->context->get('WebsiteId');
        $UserId=$this->context->get('UserId');
        $this->UserId = $UserId;
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));
        $this->customerDatas = CustomerContactTable::getCustomers($UserId);

        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new CustomerContactForm(null, array('userId' => $UserId));
        $this->processForm($request, $this->form);
        $this->setTemplate('index');

    } // End of Function


    /**
     * Function to Dynamic Process Form
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $WebsiteId= $this->context->get('WebsiteId');
        $userId = $this->context->get('UserId');
        $customerDatas = CustomerContactTable::getCustomers($userId);
        $userData = Doctrine::getTable('Users')->find(array($userId));
        $WebsiteId = $WebsiteId;
        $attachment = array();

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid())
        {
            $formFileData = $request->getFiles($form->getName());
            $formData = $request->getParameter($form->getName());
            #clsCommon::pr($customerDatas);
            #clsCommon::pr($formData);
            $mailDatas = array();
            foreach($customerDatas as $customerData)
            {
                if($customerData["FieldType"] == "FileUpload")
                {
                    $fileInfo = $formFileData["input_".$customerData["Id"]."_".$userId];
                    $mailDatas[$customerData["Label"]] = $fileInfo["name"];
                    $attachPath = $this->fileUploads($WebsiteId,$formFileData["input_".$customerData["Id"]."_".$userId]);
                    $attachment[] = $attachPath;
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
            foreach($mailDatas as $key => $mailData)
            {
                $mailTable.= "<p><strong>".$key.": </strong>".$mailData."</p>";
            }

            $themeOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($WebsiteId);

            $siteOwenerInfo = array();
            $siteOwenerInfo['UserName'] = $userData->getFirstName()." ".$userData->getLastName();
            $siteOwenerInfo['UserWebsite'] = $userData->getUsersUsersWebsite()->getWebsiteurl();
            $siteOwenerInfo['UserEmail'] = $userData->getEmail();
            $siteUrl = clsCommon::getSystemConfigVars('SITE_URL');
            $siteOwenerInfo['UserLogo'] = $siteUrl.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$WebsiteId.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR.$themeOptions['Logo'];

            //$siteOwenerInfo['UserLogo'] = $this->getRequest()->getHost().DIRECTORY_SEPARATOR."web".DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$WebsiteId.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR.$themeOptions['Logo'];
            $siteOwenerInfo['UserBGColor'] = $themeOptions['BGColor'];

            $objSiteMails = new siteMails();
            $objSiteMails->sendCustomerContactUsEmail($mailTable, $siteOwenerInfo,$attachment);

            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Your Request is sent to Site Admin");
            else
            $this->getUser()->setFlash('succMsg', "Your Request is sent to Site Admin");

            foreach($attachment as $fileAttach)
            {
                $unlinkAttach = @unlink($fileAttach);
            }

            $this->redirect('contact/index');
        }
    }

    /**
     * Function to upload the files
     *
     * @param integer $webId
     * @param array $file
     */
    public function fileUploads($webId,$file)
    {
        if (!empty($file['name']))
        {
            $attachmentPathExist = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."website".DIRECTORY_SEPARATOR.$webId;
            $this->FileDirectoryExist($attachmentPathExist);
            $attachmentPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."website".DIRECTORY_SEPARATOR.$webId.DIRECTORY_SEPARATOR."attachments".DIRECTORY_SEPARATOR;
            $ext = explode(".",$file['name']);
            $this->docOrgName = $file['name'];
            move_uploaded_file($file['tmp_name'],$attachmentPath.$this->docOrgName);
            return $attachmentPath.$this->docOrgName;
        }
    }

    /**
     * Function to check directory exist or not
     *
     * @param string $path
     */
    public function FileDirectoryExist($path)
    {
        if(!is_dir($path))
        {
            mkdir($path, 0777, true);
            $attachFile = $path.DIRECTORY_SEPARATOR."attachments";
            if(!is_dir($attachFile))
            {
                mkdir($attachFile, 0777, true);
                return true;
            }
        }
        else
        {
            $attachFile = $path.DIRECTORY_SEPARATOR."attachments";
            if(!is_dir($attachFile))
            {
                mkdir($attachFile, 0777, true);
                return true;
            }
        }
    }
}