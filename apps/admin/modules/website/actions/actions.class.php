<?php

/**
 * website actions.
 *
 * @package    counceledge
 * @subpackage website
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class websiteActions extends sfActions
{
    /**
	 * preExecutes action to set layout
	 *
	 */
    public function preExecute()
    {
        $this->setLayout("dashboard");

        $request = $this->getRequest();
        $this->customerId =$request->getParameter('customerId');
		if($this->customerId != "")
		{
			$userData = Doctrine::getTable('Users')->find(array($request->getParameter('customerId')));
			if($userData->getUserType() != sfConfig::get("app_UserType_Customer") ) //|| $userData->getStatus() == sfConfig::get("app_UserStatus_Pending")
				$this->redirect("users/index");
		}
		else
			$this->redirect("users/index");
    }


    
    /***********        START OVERVIEW CODE       ************/
    /**
	 * Executes index use for overview of theme
	 *
	 * @param sfRequest $request A request object
	 */
    public function executeIndex(sfWebRequest $request)
    {
        if($request->hasParameter('customerId'))
        {
            $this->customerId = $request->getParameter("customerId");
            $userWebsiteData = Doctrine::getTable('UsersWebsite')->findByUserId(array($request->getParameter('customerId')));
            $this->customerData = $userWebsiteData[0];
            $this->webId = $webId = $this->customerData->getId();
            $this->statisticsDetail = StatisticsTable::getDaysStatistics($webId);

            /* to get the site url */
			$oSiteConfig = Doctrine::getTable('SiteConfig')->findByConfigKey("SITE_URL");
			$asSiteUrl = $oSiteConfig->toArray();
			$this->ssSiteUrl = $asSiteUrl[0]["ConfigValue"];
			/* End the site url path */
        }
    }

    /**
	 * function is use for ajax call in webiste statistics
	 *
	 * @param sfRequest $request A request object
	 */
    public function executeUpdateWebsiteStatisticsGraph(sfWebRequest $request)
    {
		$this->setLayout(false);
		if($request->getParameter('BtnDay') && $request->getParameter('DayType')){
            $BtnDays = $request->getParameter('BtnDay');
            $DayType = $request->getParameter('DayType');

            $webId = "";
            if($request->hasParameter('webId'))
				$webId = $request->getParameter('webId');
        }
        else{
            $BtnDays = '1';
            $DayType = 'DAY';
        }

        if($request->hasParameter('webId'))
			$this->statisticsDetail = StatisticsTable::getDaysStatistics($webId, $BtnDays,$DayType);
    }
    /********       END OF OVERVIEW CODE          ********/
    /********       START CUSTOMER FAQS CODE      ********/
    /**
     * Function to Edit FAQs
     *
     * @param sfWebRequest $request
     */
    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($faqs = Doctrine::getTable('FAQs')->find(array($request->getParameter('id'))), sprintf('Object fa_qs does not exist (%s).', $request->getParameter('id')));
        $this->form = new FAQsForm($faqs);
    }

    /**
     * Function to Update FAQs
     *
     * @param sfWebRequest $request
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->customerId = $request->getPostParameter("customerId");
        $this->forward404Unless($faqs = Doctrine::getTable('FAQs')->find(array($request->getParameter('id'))), sprintf('Object fa_qs does not exist (%s).', $request->getParameter('id')));
        $this->form = new FAQsForm($faqs);

        $this->processUpdateForm($request, $this->form,$this->customerId);

        $this->setTemplate('edit');
    }

    /**
     * Function to view
     *
     * @param sfWebRequest $request
     */
    public function executeView(sfWebRequest $request)
    {
        $this->forward404Unless($faqs = Doctrine::getTable('FAQs')->find(array($request->getParameter('id'))), sprintf('Object fa_qs does not exist (%s).', $request->getParameter('id')));
        $this->form = $faqs;

        $this->setLayout("popup");
    }

    /**
     * Function to delete the customer faqs
     *
     * @param sfWebRequest $request
     */
    public function executeDeleteCustomersFaq(sfWebRequest $request)
    {
        $this->forward404Unless($faqs = Doctrine::getTable('WebsiteXFAQs')->find(array($request->getParameter('id'))), sprintf('Object fa_qs does not exist (%s).', $request->getParameter('id')));

        $dataDelete = $faqs->toArray();

        /*this function is for update the ordring of specific website id */
        $websiteXFAQs = new WebsiteXFAQs();
        $websiteXFAQs->updateOrdrAtDelete($dataDelete['WebsiteId'],$dataDelete['Ordering']);

        $faqs->delete();
        $this->getUser()->setFlash('succMsg', "Deletion successful.");

        $objectFaqs = new FAQs();
        $objectFaqs->globalDelete($dataDelete["FAQId"]);
        $customerId = $request->getParameter("customerId");
        $this->redirect("website/customerFaqsList?customerId=".$customerId);
    }

    /**
     * Function to Delete customer Website global record
     *
     * @param sfWebRequest $request
     */
    public function executeDeleteCustomerWebsiteGlobal(sfWebRequest $request)
    {
        $faqs = Doctrine::getTable('WebsiteXFAQs')->find(array($request->getParameter('id')));
        $dataDelete = $faqs->toArray();

        $websiteXFAQs = new WebsiteXFAQs();
        $websiteXFAQs->updateOrdrAtDelete($dataDelete['WebsiteId'],$dataDelete['Ordering']);

        $websiteXFAQs->deletePersonalWebsiteId($request->getParameter('id'));

        $this->getUser()->setFlash('succMsg', "Deletion successful.");

        $this->redirect('website/customerFaqsList?customerId='.$request->getParameter("customerId"));
    }

    /**
     * Function to CustomerFaqsList
     *
     * @param sfWebRequest $request
     */
    public function executeCustomerFaqsList(sfWebRequest $request)
    {
        $this->customerId = $request->getParameter("customerId");

        $userWebsiteData = Doctrine::getTable('UsersWebsite')->findByUserId(array($this->customerId));
        $this->webId = $userWebsiteData[0]->getId();

        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        /* Start of Edit FAQs*/
        if($request->hasParameter('id'))
        {
            $this->forward404Unless($faqs = Doctrine::getTable('FAQs')->find(array($request->getParameter('id'))), sprintf('Object fa_qs does not exist (%s).', $request->getParameter('id')));
            $this->form = new FAQsForm($faqs);
        }

        /*this is for website listing */
        $websiteList = Doctrine::getTable('WebsiteXFAQs')->counceledgeLegaltripListing($this->webId);
        $this->websiteLit = $websiteList->execute();
    }

    /**
     * Function to Process at Update time
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    protected function processUpdateForm(sfWebRequest $request, sfForm $form,$customerId)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid())
        {
            $faqs = $form->save();
            $faqId = $faqs->getId();

            /*set the flash message */
            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");

            $this->redirect('website/customerFaqsList?customerId='.$customerId);
        }
    }
	/**********      END OF CUSTOMER FAQS CODE   ********/

    /**********      START PRACTICE AREA CODE    ********/
    /**
     * Function to practice area listing
     *
     * @param sfWebRequest $request
     */
    public function executePracticeAreaList(sfWEbRequest $request)
    {
		$this->customerId = $request->getParameter("customerId");
		//$this->customerId = 32;
		$userWebsiteData = Doctrine::getTable('UsersWebsite')->findByUserId(array($this->customerId));
		$this->webId = $userWebsiteData[0]->getId();

		$this->orderBy = "";
		$this->orderType="";
		$this->search_text = "";
		$where = "";

		$qSearch = Doctrine_Query::create();
		$qSearch->from('WebsitePracticeArea we');
		$qSearch->where("we.Status != ?", sfConfig::get("app_Status_Deleted"));
		$qSearch->andWhere("we.WebsiteId = ?", $this->webId );

		/* Start search */
		$this->objSearchForm = new SearchWebsitePracticeArea();

		if($request->isMethod('post'))
		{
			$websitePracticeArea = $request->getParameter($this->objSearchForm->getName());
		}

		if(!empty($websitePracticeArea["search_text"]))
		{
			$this->search_text = $websitePracticeArea["search_text"];
			$qSearch->andWhere("Template LIKE '%".addslashes($websitePracticeArea["search_text"])."%'");
		}
		elseif($request->getParameter("search_text"))
		{
			$this->search_text = $request->getParameter("search_text");
			$qSearch->andWhere("Template LIKE '%".addslashes($request->getParameter("search_text"))."%'");
		}
		$this->objSearchForm->setDefault('search_text', $this->search_text );
		/* End search */

		$pager = new sfDoctrinePager('WebsitePracticeArea', sfConfig::get('app_no_of_records_per_page'));
		$pager->setQuery($qSearch);
		$pager->setPage($request->getParameter('page', 1));
		$pager->init();
		$this->pager = $pager;

    }

    /**
     * Function to edit practice area 
     *
     * @param sfWebRequest $request
     */
    public function executePracticeAreaEdit(sfWebRequest $request)
    {
		$this->forward404Unless($website_practice_area = Doctrine::getTable('WebsitePracticeArea')->find(array($request->getParameter('id'))), sprintf('Object website_practice_area does not exist (%s).', $request->getParameter('id')));
        $this->form = new WebsitePracticeAreaForm($website_practice_area,array('Id'=>$request->getParameter('id'),'webId'=>$website_practice_area->getWebsiteId()));
        $this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));
        $this->displaySlugValue  = $website_practice_area->getSlug();
        $this->customerId = $request->getParameter("customerId");
    }

    /**
     * Function to update practice area 
     *
     * @param sfWebRequest $request
     */
    public function executePracticeAreaUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($website_practice_area = Doctrine::getTable('WebsitePracticeArea')->find(array($request->getParameter('id'))), sprintf('Object website_practice_area does not exist (%s).', $request->getParameter('id')));
        $this->form = new WebsitePracticeAreaForm($website_practice_area,array('Id'=>$request->getParameter('id'),'webId'=>$website_practice_area->getWebsiteId()));
        $this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));

        $this->displaySlugValue  = $request->getPostParameter('WebsitePracticeArea[Newslug]');

		$this->customerId = $request->getPostParameter("customerId");
        $this->processPracticeAreaForm($request, $this->form, $this->customerId);

        $this->setTemplate('edit');
    }

    /**
     * Function to process the data insert or update
     *
     * @param sfWebRequest $request
     * @param sfForm       $form
     */
    protected function processPracticeAreaForm(sfWebRequest $request, sfForm $form, $customerId)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $practiceArr = $request->getParameter($form->getName());

            $form->getObject()->setSlug($practiceArr['Newslug']);
            $website_practice_area = $form->save();

            if($request->isMethod(sfRequest::PUT))
				$this->getUser()->setFlash('succMsg', "Update successful.");

            $this->redirect('website/practiceAreaList?customerId='.$customerId);
        }
    }

    /**
     * Function to delete practice area
     *
     * @param sfWebRequest $request
     */
    public function executePracticeAreaDelete(sfWebRequest $request)
    {
		$this->forward404Unless($website_practice_area = Doctrine::getTable('WebsitePracticeArea')->find(array($request->getParameter('id'))), sprintf('Object website_practice_area does not exist (%s).', $request->getParameter('id')));

        $WebsitePracticeArea = new WebsitePracticeArea();
        $WebsitePracticeArea->changeStatus($request->getParameter('id'),sfConfig::get("app_Status_Deleted"));
        $this->getUser()->setFlash('succMsg', "Deletion successful.");

        $this->redirect('website/practiceAreaList?customerId='.$request->getParameter("customerId"));

    }

	/*********    END OF PRACTICE AREA   *******/

    /**
      * THIS FUNCTION IS USE FOR FECTHING THE CUSTOMER CMS PAGE.
      */
    public function executeCustomerCms(sfWebRequest $request){
        $this->orderBy = "";
        $this->orderType = "";
        $this->varExtra = "";
        $where = "";

        $userwebsite = Doctrine_Core::getTable('UsersWebsite')->findOneBy('UserId',$request->getParameter('customerId'));

        $customerCms = $userwebsite->getId();
        $qSearch = Doctrine_Query::create();
        $qSearch->from('CMSPages cm')
        ->where('cm.WebsiteId = ?',$customerCms)
        ->andWhere('cm.Status != ?',sfConfig::get('app_Status_Deleted'))
        ->whereNotIn('cm.Slug', array('faq','contact'));

        $pager = new sfDoctrinePager('CMSPages', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

    }

    /**
     * THIS FUNCTION IS USE FOR EDIT CUSTOMER CMS PAGES.
     *
     * @param sfWebRequest $request
     */
    public function executeCustomerCmsEdit(sfWebRequest $request)
    {
        $this->forward404Unless($cms_pages = Doctrine::getTable('CMSPages')->find(array($request->getParameter('id'))), sprintf('Object CMS Pages does not exist (%s).', $request->getParameter('id')));
        $this->cmspage = $cms_pages->getSlug();
        $this->form = new CustomerPersonalCMSPagesForm($cms_pages,array('home'=>$cms_pages->getSlug(),'Id'=>$request->getParameter('id'),'webId'=>$cms_pages->getWebsiteId()));
        $this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));
        $this->displaySlugValue  = $cms_pages->getSlug();
    }

    /**
     * THIS FUNCTION IS USE FOR UPDATE CUSTOMER CMS PAGES.
     *
     * @param sfWebRequest $request
     */
    public function executeCustomerCmsUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($cms_pages = Doctrine::getTable('CMSPages')->find(array($request->getParameter('id'))), sprintf('Object CMS Pages does not exist (%s).', $request->getParameter('id')));
        $this->cmspage = $cms_pages->getSlug();
        $this->form = new CustomerPersonalCMSPagesForm($cms_pages,array('home'=>$cms_pages->getSlug(),'Id'=>$request->getParameter('id'),'webId'=>$cms_pages->getWebsiteId()));
        
        $this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));

        $this->displaySlugValue  = $_POST['personalcms']['Newslug']; 
        $this->customerCmsProcessForm($request, $this->form);

        $this->setTemplate('CustomerCmsEdit');
    }

    /**
     * THIS FUNCTION IS USE FOR DELETE THE CUSTOMER CMS STATUS.
     *
     * @param sfWebRequest $request
     */
    public function executeCustomerCmsDelete(sfWebRequest $request)
    {
        $this->forward404Unless($cms_pages = Doctrine::getTable('CMSPages')->find(array($request->getParameter('id'))), sprintf('Object CMS Pages does not exist (%s).', $request->getParameter('id')));
        $cms_pages->setStatus(sfConfig::get('app_Status_Deleted'));
        $cms_pages->save();

		$this->getUser()->setFlash('succMsg', "Deletion successful.");
        $this->redirect('website/customerCms?customerId='.$request->getParameter("customerId"));
    }

    protected function customerCmsProcessForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $perCms = $request->getParameter($form->getName());
        
        if ($form->isValid())
        {
            $temp = $this->getUser()->getAttribute('personalWebsiteId');
            /**
             *  HERE $TEMP IS USE IN PLACE OF PERSONAL WEBSITE ID SESSION.
             *  IT WILL BE REPLACE AFTER  "$this->getUser()->getAttribute('personalWebsiteId')"
             */
            if(!$request->isMethod(sfRequest::PUT)){
                $form->getObject()->setWebsiteId($temp);
            }
            $form->getObject()->setSlug($perCms['Newslug']);


            unset($form['Template']);
            unset($form['Status']);
            $form->getObject()->setStatus($perCms['Status']);
            $form->getObject()->setTemplate($perCms['Template']);


            $cms_pages = $form->save();
            $form->getObject()->setUniqueKey($temp."_".$cms_pages->getSlug());
            $cms_pages = $form->save();

            if($request->isMethod(sfRequest::PUT))
				$this->getUser()->setFlash('succMsg', "Update successful.");
            else
				$this->getUser()->setFlash('succMsg', "CMS page addedd successfully.");

            $this->redirect('website/customerCms?customerId='.$request->getParameter('customerId'));
        }
    }
}
