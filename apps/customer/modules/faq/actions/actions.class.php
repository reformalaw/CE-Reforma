<?php

/**
 * faq actions.
 *
 * @package    counceledge
 * @subpackage faq
 * @author     Chintan Fadia
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class faqActions extends sfActions
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
        /*if(is_array($arrAssetsHome)){
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
        }*/


    } // End of Function

    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
        $WebsiteId=$this->context->get('WebsiteId');
        $sql = Doctrine_Query::create()
        ->from('WebsiteXFAQs wxf')
        ->where('wxf.WebsiteId = ?', $WebsiteId)
        ->andWhere('wxf.Status = ?', sfConfig::get('app_Status_Active'))
        ->orderBy('wxf.Ordering ASC');
        $this->objFaqs = $sql->execute();

    }
}
