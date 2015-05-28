<?php

class pagesActions extends sfActions
{
    /*public function preExecute()
    {
        StatisticsTable::addIpToStatistics($this->getRequest()->getRemoteAddress(),$this->getContext()->getRequest()->getHost());
    }*/
    /**
	* Executes index action
	* @param sfRequest $request A request object
	*/
    public function executeIndex(sfWebRequest $request){

        $pageName = $request->getParameter("pagename");

        // Get Page Content
        $this->staticPage = CMSPagesTable::getStaticPage($pageName, 1);

        // If Page Not Found
        $this->forward404Unless($this->staticPage);

        // SETTING PAGE TITLE, KEYWORDS AND DESCRIPTION.
        $this->getResponse()->setTitle('Conceledge :: '.$this->staticPage->getTitle());
        $this->getResponse()->addMeta('title',$this->staticPage->getMetaTitle());
        $this->getResponse()->addMeta('keywords',$this->staticPage->getMetaKeywords());
        $this->getResponse()->addMeta('description',$this->staticPage->getMetaDescription());
    }
}
