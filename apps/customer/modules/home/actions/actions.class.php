<?php

/**
 * home actions.
 *
 * @package    counceledge
 * @subpackage home
 * @author     Chintan Fadia
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
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

        $this->setLayout('theme'.$ThemeId.'/home');

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
        if(is_array($arrAssetsHome)){
            foreach ($arrAssetsHome as $key=>$value1){
                if($key=='css'){
                    foreach ($value1 as $index=>$value2) {
                        if(substr(trim($value2),0,1)!='-')
                        $this->getResponse()->addStylesheet('theme'.$ThemeId.'/'.$value2);
                        else {
                            $value2 = substr($value2,1);
                            $this->getResponse()->removeStylesheet('theme'.$ThemeId.'/'.$value2);
                        }
                    }
                }
                if($key=='js'){
                    foreach ($value1 as $index=>$value2) {
                        if(substr(trim($value2),0,1)!='-')
                        $this->getResponse()->addJavascript('theme'.$ThemeId.'/'.$value2);
                        else {
                            $value2 = substr($value2,1);
                            $this->getResponse()->removeJavascript('theme'.$ThemeId.'/'.$value2);
                        }
                    }
                }
            }
        }

        //exit;
        /*$this->getResponse()->addStylesheet('theme'.$ThemeId.'/normalize.css');
        $this->getResponse()->addStylesheet('theme'.$ThemeId.'/style.css');
        $this->getResponse()->addStylesheet('theme'.$ThemeId.'/sequencejs-theme.modern-slide-in.css');
        $this->getResponse()->addJavascript('theme'.$ThemeId.'/modernizr-2.0.6.min.js');
        $this->getResponse()->addJavascript('theme'.$ThemeId.'/jquery.js');
        $this->getResponse()->addJavascript('theme'.$ThemeId.'/sequence.jquery-min.js');*/
    }
    /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {
        $this->websiteId = $this->context->get('WebsiteId');
        $ThemeId=$this->context->get('ThemeId');

        // insert record according to IpAddress into statistic table
        StatisticsTable::addIpToStatistics($this->getRequest()->getRemoteAddress(),$this->websiteId);

        //COMMENT : HOME PAGE CONTACT US FORM
        $this->contactForm = new CaseContactForm();
        
        /*in theme 9 we dont need to wreite message in textarea so condition is added by jaydip dodiya */
        if($ThemeId == 9 || $ThemeId == 15)
        {
        }
		else
		{
			$this->contactForm->setDefault('message','Brief Message');
		}

        //COMMENT : GET WEBSITE BANNERD
        $this->bannersArr = ThemeBannerTable::getWebsiteBanners($this->websiteId);
        
        //COMMENT : GET HOME PAGE CONTENT
        $homePage = CMSPagesTable::getHomePageData($this->websiteId);
        $this->homeData = $homePage;
        
        
        //COMMENT : SET META CONTENT FOR HOME PAGE
        $this->getResponse()->addMeta('title',$this->homeData->getMetaTitle());
        $this->getResponse()->addMeta('keywords',$this->homeData->getMetaKeywords());
        $this->getResponse()->addMeta('description',$this->homeData->getMetaDescription());
        
        
        //COMMENT : CHECK IF FORM IS POSTED & IF POSTED PROCESS IT
        if($request->isMethod('POST')){
            $this->processForm($request, $this->contactForm);
        }
           
        $this->setTemplate('index'.$ThemeId);

    } // End of If 
    
    
    protected function processForm(sfWebRequest $request, sfForm $form){
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $contact = $request->getParameter($form->getName());
        
        if($form->isValid()){
            
            $WebsiteId = $this->context->get('WebsiteId');            
            $themeOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($WebsiteId);            
            
            
            //COMMENT : RECEIVED INFORMATION
            $arrParams = array();
            $arrParams['Name'] = trim($contact['name']);
            $arrParams['Email'] = trim($contact['email']);
            $arrParams['Phone'] = trim($contact['phone']);
            $arrParams['Message'] = trim($contact['message']);
            
            //COMMENT : SITE OWNER INFORMATION
            $siteOwenerInfo = array();
            $siteOwenerInfo['UserName'] = $this->context->get('UserFirstName')." ".$this->context->get('UserLastName');
            $siteOwenerInfo['UserWebsite'] = $this->context->get('WebsiteURL');
            $siteOwenerInfo['UserEmail'] = $this->context->get('UserEmail');
            $siteUrl = clsCommon::getSystemConfigVars('SITE_URL');
            $siteOwenerInfo['UserLogo'] = $siteUrl.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$WebsiteId.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR.$themeOptions['Logo'];
            //$siteOwenerInfo['UserLogo'] = 'www.counceledge.demo.brainvire.com'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$WebsiteId.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR.$themeOptions['Logo'];

            $siteOwenerInfo['UserBGColor'] = $themeOptions['BGColor'];
            
            //COMMENT : GET THE OBJECT OF MAIL CLASS
            $objSiteMails = new siteMails();

            //COMMENT : CALL TO CONTACT US MAIL MEHTOD OF MAIL CLASS
            $objSiteMails->sendCaseContactUsEmail($arrParams, $siteOwenerInfo);

            $this->getUser()->setFlash("succMsg","Your Request is sent to Site Admin");
            $this->redirect('/');
        }
    }    // End of Function
}
