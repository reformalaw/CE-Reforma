<?php

/**
 * pages actions.
 *
 * @package    counceledge
 * @subpackage pages
 * @author     Chintan Fadia
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pagesActions extends sfActions
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

        #$this->setLayout('theme'.$ThemeId.'/home');

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
        $this->page = Doctrine_Core::getTable('CMSPages')->findOneBySlugAndWebsiteidAndStatus(
        $request->getParameter('slug'),
        $request->getParameter('client_id'),
        'Active'
        );

        $this->forward404Unless($this->page);

        // Set Site Layout
        $ThemeId=$this->context->get('ThemeId');
        $this->setLayout('theme'.$ThemeId.'/'.$this->page->getTemplate());
        #echo $this->getlayout();

        // Set Meta Content
        $this->getResponse()->addMeta('title',$this->page->getMetaTitle());
        $this->getResponse()->addMeta('keywords',$this->page->getMetaKeywords());
        $this->getResponse()->addMeta('description',$this->page->getMetaDescription());



    }

    /**
    * Executes Sow action for Practice Area 
    *
    * @param sfRequest $request A request object
    */
    public function executeShow(sfWebRequest $request)
    {
        $this->practiceArea = Doctrine_Core::getTable('WebsitePracticeArea')->findOneBySlugAndWebsiteidAndStatus(
        $request->getParameter('slug'),
        $request->getParameter('client_id'),
        'Active'
        );

        $this->forward404Unless($this->practiceArea);

        // Set Site Layout
        $ThemeId=$this->context->get('ThemeId');
        $this->setLayout('theme'.$ThemeId.'/'.$this->practiceArea->getTemplate());
        #echo $this->getlayout();

        // Set Meta Content

        $this->getResponse()->addMeta('title',$this->practiceArea->getMetaTitle());
        $this->getResponse()->addMeta('keywords',$this->practiceArea->getMetaKeywords());
        $this->getResponse()->addMeta('description',$this->practiceArea->getMetaDescription());



    }

}
