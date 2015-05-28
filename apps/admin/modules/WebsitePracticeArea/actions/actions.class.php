<?php

/**
 * WebsitePracticeArea actions.
 *
 * @package    counceledge
 * @subpackage WebsitePracticeArea
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class WebsitePracticeAreaActions extends sfActions
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
     * Function to listing
     *
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {
        /* Set the website url in to session  to display into the title */
        $webId = $this->getUser()->getAttribute('personalWebsiteId');

        $this->orderBy = "";
        $this->orderType="";
        $this->search_text = "";
        $where = "";

		$qSearch = Doctrine_Query::create();
		$qSearch->from('WebsitePracticeArea we');
		$qSearch->where("we.Status != ?", sfConfig::get("app_Status_Deleted"));
		$qSearch->andWhere("we.WebsiteId = ?", $webId );

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

        switch($request->getParameter('orderBy'))
        {
            case "Template":
                $orderBy = 'Template';
                $this->orderBy = "Template";
                break;
            case "Title":
                $orderBy = 'Title';
                $this->orderBy = "Title";
                break;
            default:
                $orderBy = 'Id';
                $this->orderBy = "Id";
                break;

        }

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

        #echo $qSearch;
        $pager = new sfDoctrinePager('WebsitePracticeArea', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    }

    /**
     * Function to Insert New Record
     *
     * @param sfWebRequest $request
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new WebsitePracticeAreaForm();
        $this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));
        $this->displaySlugValue  = '';

    }

    /**
     * Function to Insert Create Record
     *
     * @param sfWebRequest $request
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new WebsitePracticeAreaForm();
        $this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));
        $this->displaySlugValue  = $_POST['WebsitePracticeArea']['Newslug'];
        $redirectFlag = $request->getPostParameter('submit');
        $this->processForm($request, $this->form, $redirectFlag);
        $this->setTemplate('new');
    }

    /**
     * Function to Edit Record
     *
     * @param sfWebRequest $request
     */
    public function executeEdit(sfWebRequest $request)
    {
		if(clsCommon::chkDataExist("WebsitePracticeArea", $request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$this->forward404Unless($website_practice_area = Doctrine::getTable('WebsitePracticeArea')->find(array($request->getParameter('id'))), sprintf('Object website_practice_area does not exist (%s).', $request->getParameter('id')));
			$this->form = new WebsitePracticeAreaForm($website_practice_area,array("Id"=>$request->getParameter('id'),"webId"=>$website_practice_area->getWebsiteId()));
			$this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));
			$this->displaySlugValue  = $website_practice_area->getSlug();
        }
        else
		{
			$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
			$this->redirect('default/index');
		}

    }

    /**
     * Function to Update Record
     *
     * @param sfWebRequest $request
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($website_practice_area = Doctrine::getTable('WebsitePracticeArea')->find(array($request->getParameter('id'))), sprintf('Object website_practice_area does not exist (%s).', $request->getParameter('id')));
        $this->form = new WebsitePracticeAreaForm($website_practice_area,array("Id"=>$request->getParameter('id'),"webId"=>$website_practice_area->getWebsiteId()));
        $this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));

        $this->displaySlugValue  = $_POST['WebsitePracticeArea']['Newslug'];

		$redirectFlag = $request->getPostParameter('submit');
        $this->processForm($request, $this->form, $redirectFlag);

        $this->setTemplate('edit');
    }

    /**
     * Function to Delete Record
     *
     * @param sfWebRequest $request
     */
    public function executeDelete(sfWebRequest $request)
    {
		if(clsCommon::chkDataExist("WebsitePracticeArea", $request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$this->forward404Unless($website_practice_area = Doctrine::getTable('WebsitePracticeArea')->find(array($request->getParameter('id'))), sprintf('Object website_practice_area does not exist (%s).', $request->getParameter('id')));

			$oWebsitePracticeArea = new WebsitePracticeArea();
			$oWebsitePracticeArea->changeStatus($request->getParameter('id'),sfConfig::get("app_Status_Deleted"));
			$this->getUser()->setFlash('succMsg', "Deletion successful.");

			$this->redirect('WebsitePracticeArea/index');
		}
		else
		{
			$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
			$this->redirect('default/index');
		}
    }

    /**
     * Function to process the data insert or update
     *
     * @param sfWebRequest $request
     * @param sfForm       $form
     */
    protected function processForm(sfWebRequest $request, sfForm $form, $redirectFlag="")
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {

            $practiceArr = $request->getParameter($form->getName());

            $webId = $this->getUser()->getAttribute('personalWebsiteId');


            if(!$request->isMethod(sfRequest::PUT)){
                $form->getObject()->setWebsiteId($webId);
            }
            $form->getObject()->setSlug($practiceArr['Newslug']);
            $website_practice_area = $form->save();

            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "Practice Area added successfully.");

            if($request->isMethod(sfRequest::PUT)){
				if($redirectFlag == "Save"):
					$this->redirect('WebsitePracticeArea/edit?id='.$website_practice_area->getId());
				elseif($redirectFlag == "Save And Quit"):
					$this->redirect('WebsitePracticeArea/index');
				elseif($redirectFlag == "Save And Preview"):
					$this->redirect('WebsitePracticeArea/edit?id='.$website_practice_area->getId().'&flagPreview=1');
				else:
					$this->redirect('WebsitePracticeArea/index');
				endif;
            }
            else
            {
				if($redirectFlag == "Save"):
					$this->redirect('WebsitePracticeArea/edit?id='.$website_practice_area->getId());
				elseif($redirectFlag == "Save And Quit"):
					$this->redirect('WebsitePracticeArea/index');
				elseif($redirectFlag == "Save And Preview"):
					$this->redirect('WebsitePracticeArea/edit?id='.$website_practice_area->getId().'&flagPreview=1');
				else:
					$this->redirect('WebsitePracticeArea/index');
				endif;
				
			}
			
            $this->redirect('WebsitePracticeArea/index');
        }
    }

    /**
     * Function to view the record
     *
     * @param sfWebRequest $request
     */
    public function executeView(sfWebRequest $request)
    {
        $snId = $request->getParameter("id");
        $oWebsitePracticeArea = new WebsitePracticeArea();
        $asResult = $oWebsitePracticeArea->viewPracticeArea($snId);

        $this->form = $asResult[0];
    }

    /**
     * Function to change the status
     *
     * @param sfWebRequest $request
     */
    public function executeChangePracticeAreaStatus(sfWebRequest $request)
    {
		if(clsCommon::chkDataExist("WebsitePracticeArea", $request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$snId 		= 	$request->getParameter('id');
			$ssStatus 	= 	$request->getParameter('status');
			$oWebsitePracticeArea = new WebsitePracticeArea();
			$oWebsitePracticeArea->changeStatus($snId, $ssStatus);

			if($ssStatus == sfConfig::get("app_Status_Active"))
			$successMessage = "active";
			else
			$successMessage = "inactive";

			$this->getUser()->setFlash("succMsg",'Status successfully changed to '.$successMessage.'.');

			$this->redirect('WebsitePracticeArea/index');
        }
        else
		{
			$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
			$this->redirect('default/index');
		}
    }


    /**
     * Function to Generate Slug Field based on Practice Area Title
     *
     * @param sfWebRequest $request
     * @return Sluggable Value
     */

    public function executeGetPageSlug(sfWebRequest $request)
    {
        $title =  $request->getParameter('title');
        $act =  $request->getParameter('act');
        $id=  $request->getParameter('id');
        
        $websiteId = $this->getUser()->getAttribute('personalWebsiteId');
        $slugTitle = clsCommon::slugify($title);

        // Check if Slug is reserved for Website, creted for Routing issues
        $reservedSlugForPageAndPracticeArea = sfConfig::get('app_ReservedSlugForPageAndPracticeArea_keywords') ;
        if(in_array($slugTitle, $reservedSlugForPageAndPracticeArea)) {
            $slugTitle = $slugTitle.'1';
        }
        
        
        $checkSlug = WebsitePracticeAreaTable::checkSlugExist($websiteId, $slugTitle, $act, $id);
        if (count($checkSlug)>0) {
            $slugTitle = $checkSlug[0]['Slug'].'-'.count($checkSlug);
            return $this->renderText("$slugTitle");
        }else {
            return $this->renderText("$slugTitle");
        }
    } // End of Function 
}
