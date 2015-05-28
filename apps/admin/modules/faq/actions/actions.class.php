<?php

/**
 * faq actions.
 *
 * @package    counceledge
 * @subpackage faq
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class faqActions extends sfActions
{
    /**
    * HERE IN THIS FUNCTION WE ARE CHECKING THAT USER IS NOT ADMIN AND PERMISSION CHECK IS FALSE
    * THE REDIRECT TO THE NOT AUTHENTICATED PAGE.
    */
    public function preExecute()
    {
       if (clsCommon::permissionCheck($this->getModuleName()."/".$this->getActionName()) == false){
            $this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
            $this->redirect('default/index');
        }
    }
    /**
     * Function to listing of Globle FAQs Listing
     *
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        /* this is for listing query */
        $qSearch = Doctrine::getTable('FAQs')->FAQsListing();

        /*this switch is for Sorting the Table */
        switch($request->getParameter('orderBy'))
        {
            case "Globle":
                $orderBy = 'fa.Globle';
                $this->orderBy = "Globle";
                break;
            case "Question":
                $orderBy = 'fa.Question';
                $this->orderBy = "Question";
                break;
            case "CreateDateTime":
                $orderBy = 'fa.CreateDateTime';
                $this->orderBy = "CreateDateTime";
                break;
            default:
                $orderBy = 'fa.Id';
                $this->orderBy = "Id";
                break;
        }

        /* this switch is for default Desc or for sorting */
        switch($request->getParameter('orderType'))
        {
            case "asc":
                $qSearch->orderBy("$orderBy asc");
                $this->orderType = "asc";
                break;
            case "desc":
            default:
                $qSearch->orderBy("$orderBy desc");
                $this->orderType = "desc";
                break;
        }

        $pager = new sfDoctrinePager('Faqs', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

        //$this->pager = $qSearch->execute();
    }

    /**
     * Function to New FAQs
     *
     * @param sfWebRequest $request
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->webId = ($request->getParameter('webId') ? $request->getParameter('webId') : 0);
        $this->form = new FAQsForm(array(),array('webId'=>$this->webId));

        if($this->webId == 1)
        $this->newTitle = "Add To Counsel Edge";
        elseif($this->webId == 2)
        $this->newTitle = "Add To Leagalgrip";
        elseif($this->webId == 0)
        $this->newTitle = "Add To Global Faq";
        else
        $this->newTitle = "Add To Website Faq";
    }


    /**
     * Function to Create FAQs
     *
     * @param sfWebRequest $request
     */
    public function executeCreate(sfWebRequest $request)
    {

        $this->webId = $request->getPostParameter("hiddenWebsiteId");

        if($this->webId == 1)
        $this->newTitle = "Add To Counsel Edge";
        elseif($this->webId == 2)
        $this->newTitle = "Add To Leagalgrip";
        elseif($this->webId == 0)
        $this->newTitle = "Add To Global Faq";
        else
        $this->newTitle = "Add To Website Faq";

        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new FAQsForm(array(),array('webId'=>$this->webId));
        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * Function to Edit FAQs
     *
     * @param sfWebRequest $request
     */
    public function executeEdit(sfWebRequest $request)
    {
        $webId = $request->getParameter('webId');
        $this->webId = $webId;
        $this->forward404Unless($fa_qs = Doctrine::getTable('FAQs')->find(array($request->getParameter('id'))), sprintf('Object fa_qs does not exist (%s).', $request->getParameter('id')));
        $this->form = new FAQsForm($fa_qs,array('webId'=>$webId));

        if($webId == 1)
        $this->EditTitle = "Edit CE Faq";
        elseif($webId == 2)
        $this->EditTitle = "Edit LG Faq";
        elseif($webId == 0)
        $this->EditTitle = "Edit Global Faq";
        else
        $this->EditTitle = "Edit Website Faq";
    }


    /**
     * Function to Update FAQs
     *
     * @param sfWebRequest $request
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->webId =$request->getPostParameter("hiddenWebsiteId");

        if($this->webId == 1)
        $this->EditTitle = "Edit CE Faq";
        elseif($this->webId == 2)
        $this->EditTitle = "Edit LG Faq";
        elseif($this->webId == 0)
        $this->EditTitle = "Edit Global Faq";
        else
        $this->EditTitle = "Edit Website Faq";

        #$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($fa_qs = Doctrine::getTable('FAQs')->find(array($request->getParameter('id'))), sprintf('Object fa_qs does not exist (%s).', $request->getParameter('id')));
        $this->form = new FAQsForm($fa_qs,array('webId'=>$this->webId));

        $this->processUpdateForm($request, $this->form);

        $this->setTemplate('edit');
    }

    /**
     * Function to Delete Global FAQs
     *
     * @param sfWebRequest $request
     */
    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($fa_qs = Doctrine::getTable('FAQs')->find(array($request->getParameter('id'))), sprintf('Object fa_qs does not exist (%s).', $request->getParameter('id')));
        $oWebsiteXFAQs = new WebsiteXFAQs();

        /* find the wesiteId and ordering of this id */
        $websiteIdData = $oWebsiteXFAQs->getWebsiteIdGloble($request->getParameter('id'));

        /*this foreach is for update the ordering of all websiteId */
        foreach($websiteIdData as $asWebsiteIdData)
        {
            $oWebsiteXFAQs->updateOrdrAtDelete($asWebsiteIdData["WebsiteId"], $asWebsiteIdData["Ordering"]);
        }

        /* this function is for delete the all record of WebsiteXFAQs table of this id */
        $oWebsiteXFAQs->deleteWithGlobal($request->getParameter('id'));
        $fa_qs->delete();
        $this->getUser()->setFlash('errMsg', "Deletion successful.");

        $this->redirect('@faq_list');
    }


    /**
     * Function to Process at add time
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $ssFormValue = $request->getParameter($form->getName());

        if ($form->isValid())
        {
            /* if web id is 1 or 2 then set the globle No */
            if($ssFormValue['webId'] == 1 || $ssFormValue['webId'] == 2 || $ssFormValue['webId'] != 0)
            $form->getObject()->setGloble("No");
            else
            $form->getObject()->setGloble("Yes");

            $fa_qs = $form->save();
            $faqId = $fa_qs->getId();

            /*save record in WebsiteXFAQs table */
            if($ssFormValue['webId'] == 1 || $ssFormValue['webId'] == 2 || $ssFormValue['webId'] != 0)
            {
                /* this is for inserting in WebsiteXFAQs table */
                $oWebsiteXFAQs = new WebsiteXFAQs();
                $Ordering = $oWebsiteXFAQs->maxOrder($ssFormValue['webId']);

                $oWebsiteXFAQs->saveCounceledgeLigaltrip($faqId, $ssFormValue['webId'], ($Ordering+1), sfConfig::get('app_FAQs_Active'));
            }

            /*set the flash message */
            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "New FAQ added successfully.");

            /* redirect to listing according to webId */
            if($ssFormValue['webId'] == 1 )
            $this->redirect('faq/counceledgeList');
            elseif($ssFormValue['webId'] == 2)
            $this->redirect('faq/leagaltripList');
            elseif($ssFormValue['webId'] == 0)
            $this->redirect('@faq_list');
            else
            $this->redirect('faq/personalWebsiteList');
        }
    }

    /**
     * Function to Process at Update time
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    protected function processUpdateForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $ssFormValue = $request->getParameter($form->getName());

        if ($form->isValid())
        {
            $fa_qs = $form->save();
            $faqId = $fa_qs->getId();

            /*set the flash message */
            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "New FAQ added successfully.");

            #clsCommon::pr($ssFormValue,1);
            /* redirect to listing according to webId */
            if($ssFormValue['webId'] == 1 )
            $this->redirect('faq/counceledgeList');
            elseif($ssFormValue['webId'] == 2)
            $this->redirect('faq/leagaltripList');
            elseif($ssFormValue['webId'] == 0)
            $this->redirect('@faq_list');
            else
            $this->redirect('faq/personalWebsiteList');
        }
    }

    /**
     * Function to Change status of Global
     *
     * @param sfWebRequest $request
     */
    public function executeChangeStatus(sfWebRequest $request)
    {
        $snId 		= 	$request->getParameter('id');
        $ssStatus 	= 	$request->getParameter('status');

        /* this is the updatestatus query */
        $oFAQs = new FAQs();
        $oFAQs->updateStatus($snId,$ssStatus);
        $oWebsiteXFAQs = new WebsiteXFAQs();
        $oWebsiteXFAQs->GlobalStatusChange($snId,$ssStatus);

        if($ssStatus == sfConfig::get("app_Status_Active"))
        $this->getUser()->setFlash("succMsg",'Status successfully changed to Active.');
        else
        $this->getUser()->setFlash("errMsg",'Status successfully changed to inactive.');

        $this->redirect('@faq_list');
    }

    /**
     * Function to Change status of Counceledge
     *
     * @param sfWebRequest $request
     */
    public function executeChangeStatusCounceledge(sfWebRequest $request)
    {
        $webId		=	$request->getParameter('webId');
        $snId 		= 	$request->getParameter('id');
        $ssStatus 	= 	$request->getParameter('status');

        /* this is for updateStatusCounceledge query */
        $oWebsiteXFAQs = new WebsiteXFAQs();
        $oWebsiteXFAQs->updateStatusCounceledge($snId,$ssStatus);

        if($ssStatus == sfConfig::get("app_Status_Active"))
        $this->getUser()->setFlash("succMsg",'Status successfully changed to active.');
        else
        $this->getUser()->setFlash("errMsg",'Status successfully changed to inactive.');

        if($webId == 1)
        {
            $this->redirect('faq/counceledgeList');
        }
        elseif($webId == 2)
        {
            $this->redirect('faq/leagaltripList');
        }
        else
        {
            $this->redirect('faq/personalWebsiteList');
        }
    }


    /**
     * Function to listing of Counceledge
     *
     * @param sfWebRequest $request
     */
    public function executeCounceledgeList(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        /* this query is for counceledge Listing */
        $qSearch = Doctrine::getTable('WebsiteXFAQs')->counceledgeLegaltripListing(1);
        $this->pager = $qSearch->execute();
    }

    /**
     * Function to delete the Counceledge
     *
     * @param sfWebRequest $request
     */
    public function executeDeleteCounceledge(sfWebRequest $request)
    {
        $this->forward404Unless($fa_qs = Doctrine::getTable('WebsiteXFAQs')->find(array($request->getParameter('id'))), sprintf('Object fa_qs does not exist (%s).', $request->getParameter('id')));

        $dataDelete = $fa_qs->toArray();

        /*this function is for update the ordring of specific website id */
        $oWebsiteXFAQs = new WebsiteXFAQs();
        $oWebsiteXFAQs->updateOrdrAtDelete($dataDelete['WebsiteId'],$dataDelete['Ordering']);

        $fa_qs->delete();

        $oFAQs = new FAQs();
        $oFAQs->globalDelete($dataDelete["FAQId"]);

        $webId = $request->getParameter('webId');
        if($webId == 1)
        {
            $this->getUser()->setFlash('errMsg', "Deletion successful.");
            $this->redirect('faq/counceledgeList');
        }
        elseif($webId == 2)
        {
            $this->getUser()->setFlash('errMsg', "Deletion successful.");
            $this->redirect('faq/leagaltripList');
        }
        else
        {
            $this->getUser()->setFlash('errMsg', "Deletion successful.");
            $this->redirect('faq/personalWebsiteList');
        }
    }

    /**
     * Function to listing of LeagaltripList
     *
     * @param sfWebRequest $request
     */
    public function executeLeagaltripList(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        $qSearch = Doctrine::getTable('WebsiteXFAQs')->counceledgeLegaltripListing(2);
        $this->pager = $qSearch->execute();
    }

    /**
     * Function to Inserting record in table when you click on checkbox
     *
     * @param sfWebRequest $request
     */
    public function executeAjaxInsertWebsiteXFAQs(sfWebRequest $request)
    {
        if($request->isXmlHttpRequest())
        {
            $faqId 		= $request->getParameter('FAQId');
            $WebsiteId 	= $request->getParameter('WebsiteId');
            $Status 		= $request->getParameter('Status');

            $oWebsiteXFAQs = new WebsiteXFAQs();

            $Ordering = $oWebsiteXFAQs->maxOrder($WebsiteId);
            //$Ordering = $maxOrder[0]['MAX']+1;

            $oWebsiteXFAQs->saveCounceledgeLigaltrip($faqId, $WebsiteId, ($Ordering+1), sfConfig::get('app_FAQs_Active'));
        }
        return sfView::NONE;
    }

    /**
     * Function to delete when you uncheck the checkbox
     *
     * @param sfWebRequest $request
     */
    public function executeAjaxDeleteWebsiteXFAQs(sfWebRequest $request)
    {

        if($request->isXmlHttpRequest())
        {
            $faqId 		= $request->getParameter('FAQId');
            $WebsiteId 	= $request->getParameter('WebsiteId');
            $oWebsiteXFAQs = new WebsiteXFAQs();
            $oWebsiteXFAQs->AjaxDelete($faqId,$WebsiteId);
        }
        return sfView::NONE;
    }

    /**
     * Function to view
     *
     * @param sfWebRequest $request
     */
    public function executeView(sfWebRequest $request)
    {
        $webId = $request->getParameter('webId');
        $this->webId = $webId;
        $this->forward404Unless($fa_qs = Doctrine::getTable('FAQs')->find(array($request->getParameter('id'))), sprintf('Object fa_qs does not exist (%s).', $request->getParameter('id')));
        $this->form = new FAQsForm($fa_qs,array('webId'=>$webId));

        if($webId == 1)
			$this->EditTitle = "View CE Faq";
        elseif($webId == 2)
			$this->EditTitle = "View LG Faq";
        elseif($webId == 0)
			$this->EditTitle = "View Global Faq";
        else
			$this->EditTitle = "View Website Faq";

		$this->setLayout("popup");

    }

    /**
     * Function to ordering of listing
     *
     * @param sfWebRequest $request
     */
    public function executeGlobelOrdering(sfWebRequest $request)
    {
        $anOrdering = $request->getParameter('recordsArray');
        $oWebsiteXFAQs = new WebsiteXFAQs();
        foreach($anOrdering as $key => $snOrderning)
        {
            $oWebsiteXFAQs->updateOrdering($snOrderning,$key);
        }
        return sfView::NONE;
    }

    /**
     * Function to personalWebsiteList
     *
     * @param sfWebRequest $request
     */
    public function executePersonalWebsiteList(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        $this->webId = $this->getUser()->getAttribute('personalWebsiteId');

        /* Start of Add Edit FAQs*/
        if($request->hasParameter('id'))
        {
            $webId = $request->getParameter('webId');
            $this->webId = $webId;

            if(clsCommon::chkDataExistOrNot("WebsiteXFAQs", "FAQId", "WebsiteId", $request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
            {
				$this->forward404Unless($fa_qs = Doctrine::getTable('FAQs')->find(array($request->getParameter('id'))), sprintf('Object fa_qs does not exist (%s).', $request->getParameter('id')));
				$this->form = new FAQsForm($fa_qs,array('webId'=>$webId));
			}
			else
			{
				$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
				$this->redirect('default/index');
			}
        }
        else
        {
            $this->form = new FAQsForm(array(),array('webId'=>$this->webId));
        }
        if($request->isMethod(sfRequest::POST))
        {
            $this->form = new FAQsForm(array(),array('webId'=>$this->webId));
            $this->processForm($request, $this->form);
        }
        /* End of Add Edit FAQs */

        /*this is for website listing */
        $websiteList = Doctrine::getTable('WebsiteXFAQs')->counceledgeLegaltripListing($this->webId);
        $this->websiteLit = $websiteList->execute();
    }

    /**
     * Function to Delete Personal Website Record
     *
     * @param sfWebRequest $request
     */
    public function executeDeletePersonalWebsiteGlobal(sfWebRequest $request)
    {
		if(clsCommon::chkDataExist("WebsiteXFAQs", $request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$fa_qs = Doctrine::getTable('WebsiteXFAQs')->find(array($request->getParameter('id')));
			$dataDelete = $fa_qs->toArray();

			$oWebsiteXFAQs = new WebsiteXFAQs();
			$oWebsiteXFAQs->updateOrdrAtDelete($dataDelete['WebsiteId'],$dataDelete['Ordering']);

			$oWebsiteXFAQs->deletePersonalWebsiteId($request->getParameter('id'));

			$this->getUser()->setFlash('errMsg', "Deletion successful.");
			$this->redirect('faq/personalWebsiteList');
        }
        else
        {
			$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
			$this->redirect('default/index');
		}
    }

    /**
     * Function to GlobalFAQs 
     *
     * @param sfWebRequest $request
     */
    public function executeGlobalfaqs(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        $this->webId = $this->getUser()->getAttribute('personalWebsiteId');

        $oWebsiteXFAQs = new WebsiteXFAQs();

        /*add personal website's records */
        if($request->isMethod(sfRequest::POST))
        {
            $checkboxIds = $request->getParameter('websiteId');
            foreach($checkboxIds as $ckeckboxId)
            {
                $Ordering = $oWebsiteXFAQs->maxOrder($this->webId);
                $oWebsiteXFAQs->saveCounceledgeLigaltrip($ckeckboxId, $this->webId, ($Ordering+1), sfConfig::get('app_FAQs_Active'));
            }
        }

        $allIds = $oWebsiteXFAQs->getIdsList($this->webId);

        $ids = array();
        foreach($allIds as $key => $allId)
        {
            $ids[$key] = $allId["FAQId"];
        }

        if(count($ids) <= 0 )
        $ids = array(0 => 0);

        $oFAQs = new FAQs();
        $qSearch = $oFAQs->getPersonalList($ids);


        /* this is for listing query */
        $pager = new sfDoctrinePager('Faqs', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

    }

    /**
     * Function to change status personal website
     *
     * @param sfWebRequest $request
     */
    public function executeChangeStatusPersonalWebsite(sfWEbRequest $request)
    {
		if(clsCommon::chkDataExist("WebsiteXFAQs", $request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$webId		=	$request->getParameter('webId');
			$snId 		= 	$request->getParameter('id');
			$ssStatus 	= 	$request->getParameter('status');

			$oWebsiteXFAQs = new WebsiteXFAQs();
			$oWebsiteXFAQs->updateStatusCounceledge($snId,$ssStatus);

			if($ssStatus == sfConfig::get("app_Status_Active"))
			$this->getUser()->setFlash("succMsg",'Status successfully changed to active.');
			else
			$this->getUser()->setFlash("errMsg",'Status successfully changed to inactive.');

			$this->redirect('faq/personalWebsiteList');
		}
		else
        {
			$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
			$this->redirect('default/index');
		}

    }
    
    /**
     * Function to delete personal website
     *
     * @param sfWebRequest $request
     */
    public function executeDeletePersonalFaqs(sfWebRequest $request)
    {
		if(clsCommon::chkDataExist("WebsiteXFAQs", $request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$this->forward404Unless($fa_qs = Doctrine::getTable('WebsiteXFAQs')->find(array($request->getParameter('id'))), sprintf('Object fa_qs does not exist (%s).', $request->getParameter('id')));

			$dataDelete = $fa_qs->toArray();

			/*this function is for update the ordring of specific website id */
			$oWebsiteXFAQs = new WebsiteXFAQs();
			$oWebsiteXFAQs->updateOrdrAtDelete($dataDelete['WebsiteId'],$dataDelete['Ordering']);

			$fa_qs->delete();

			$oFAQs = new FAQs();
			$oFAQs->globalDelete($dataDelete["FAQId"]);

			$this->getUser()->setFlash('errMsg', "Deletion successful.");
			$this->redirect('faq/personalWebsiteList');
		}
		else
        {
			$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
			$this->redirect('default/index');
		}

    }
}
