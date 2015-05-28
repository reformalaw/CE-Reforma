<?php

class faqsActions extends sfActions
{
    /*public function preExecute()
    {
        StatisticsTable::addIpToStatistics($this->getRequest()->getRemoteAddress(),$this->getContext()->getRequest()->getHost());
    }*/
    
    public function executeIndex()
    {
        $this->faqs = WebsiteXFAQsTable::getFaqsQuestionAnswerForView();

        // SETTING PAGE TITLE,KEYWORDS & DESCRIPTION
        $this->getResponse()->setTitle('Conceledge :: FAQs');
        $this->getResponse()->addMeta('title','faqs meta title');
        $this->getResponse()->addMeta('keywords','faqs meta keywords');
        $this->getResponse()->addMeta('description','this is meta description for faqs page.');
    }
}
