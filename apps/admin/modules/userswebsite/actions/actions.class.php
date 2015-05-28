<?php

/**
 * userswebsite actions.
 *
 * @package    counceledge
 * @subpackage userswebsite
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userswebsiteActions extends sfActions
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
     * Function to Listing userswebsite
     *
     * @param sfWebRequest $request
     */
	public function executeIndex(sfWebRequest $request)
	{
		$this->orderBy = "";
		$this->orderType="";
		$where = "";
		$this->field_type="";
		$this->search_text = "";
		$this->search_status = "";

		/* to get the site url */
		$oSiteConfig = Doctrine::getTable('SiteConfig')->findByConfigKey("SITE_URL");
		$asSiteUrl = $oSiteConfig->toArray();
		$this->ssSiteUrl = $asSiteUrl[0]["ConfigValue"];
		/* End the site url path */
		
		$oUsersWebsite = new UsersWebsite();
		$qSearch = $oUsersWebsite->userWebsiteList();

		$this->objSearchForm = new SearchUserWebsiteForm();
	
		if($request->isMethod('post'))
		{
			$websitename = $request->getParameter($this->objSearchForm->getName());
		}

		if((!empty($websitename["search_text"]) && !empty($websitename["field_type"])) || (!empty($websitename["field_type"]) && !empty($websitename["search_status"])) )
		{
			if(!empty($websitename["search_text"]) && !empty($websitename["field_type"]))
			{
				$this->search_text = $websitename["search_text"];
				$this->field_type = $websitename["field_type"];
				$qSearch->andWhere($websitename["field_type"]." LIKE '%".addslashes($websitename["search_text"])."%'");
			}
			elseif(!empty($websitename["field_type"]) && !empty($websitename["search_status"]))
			{
				$this->search_status = $websitename["search_status"];
				$this->field_type = $websitename["field_type"];
				$qSearch->andWhere($websitename["field_type"]." = ?",addslashes($websitename["search_status"]));
			}
		}
		elseif(($request->getParameter("search_text") && $request->getParameter("field_type")) || ($request->getParameter("search_status") && $request->getParameter("field_type")))
		{
			if($request->getParameter("search_text") && $request->getParameter("field_type"))
			{
				$this->search_text = $request->getParameter("search_text");
				$this->field_type = $request->getParameter("field_type");
				$qSearch->andWhere($request->getParameter("field_type")." LIKE '%".addslashes($request->getParameter("search_text"))."%'");

			}
			elseif($request->getParameter("search_status") && $request->getParameter("field_type"))
			{
				$this->search_status = $request->getParameter("search_status");
				$this->field_type = $request->getParameter("field_type");
				$qSearch->andWhere($request->getParameter("field_type")." = ?",addslashes($request->getParameter("search_status")));
			}
		}
		$this->objSearchForm->setDefault('search_text', $this->search_text );
		$this->objSearchForm->setDefault('field_type', $this->field_type );
		$this->objSearchForm->setDefault('search_status', $this->search_status );
	
	//     $qSearch = Doctrine_Query::create();
	//     $qSearch->from('UsersWebsite us');

		/*if($request->getParameter('search_text'))
		$where .="us.name LIKE '%".$request->getParameter('search_text')."%'";

		$qSearch->where($where);*/

		switch($request->getParameter('orderBy'))
		{
			case "Websiteurl":
				$orderBy = 'Websiteurl';
				$this->orderBy = "Websiteurl";
				break;
			case "CreateDateTime":
				$orderBy = 'CreateDateTime';
				$this->orderBy = "CreateDateTime";
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


		$pager = new sfDoctrinePager('UsersWebsite', sfConfig::get('app_no_of_records_per_page'));
		$pager->setQuery($qSearch);
		$pager->setPage($request->getParameter('page', 1));
		$pager->init();
		$this->pager = $pager; 
	}

	/**
     * Function to New userswebsite
     *
     * @param sfWebRequest $request
     */
	public function executeNew(sfWebRequest $request)
	{
		$this->form = new UsersWebsiteForm();
	}

	/**
     * Function to Create userswebsite
     *
     * @param sfWebRequest $request
     */
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new UsersWebsiteForm();
		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	/**
     * Function to Edit userswebsite
     *
     * @param sfWebRequest $request
     */
	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404Unless($users_website = Doctrine::getTable('UsersWebsite')->find(array($request->getParameter('id'))), sprintf('Object users_website does not exist (%s).', $request->getParameter('id')));
		$this->form = new UsersWebsiteForm($users_website);
	}

	/**
     * Function to Update userswebsite
     *
     * @param sfWebRequest $request
     */
	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($users_website = Doctrine::getTable('UsersWebsite')->find(array($request->getParameter('id'))), sprintf('Object users_website does not exist (%s).', $request->getParameter('id')));
		$this->form = new UsersWebsiteForm($users_website);

		$this->processForm($request, $this->form);

		$this->setTemplate('edit');
	}

	/**
     * Function to Delete userswebsite
     *
     * @param sfWebRequest $request
     */
	public function executeDelete(sfWebRequest $request)
	{
		$this->forward404Unless($users_website = Doctrine::getTable('UsersWebsite')->find(array($request->getParameter('id'))), sprintf('Object users_website does not exist (%s).', $request->getParameter('id')));
		$users_website->delete();
		$this->getUser()->setFlash('succMsg', "Deletion successful.");

		$this->redirect('userswebsite/index');
	}

	/**
     * Function to Process Form of userswebsite
     *
     * @param sfWebRequest $request
     */
	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$users_website = $form->save();
		
			if($request->isMethod(sfRequest::PUT))
				$this->getUser()->setFlash('succMsg', "Update successful.");
			else 
				$this->getUser()->setFlash('succMsg', "New users website added successfully.");

			$this->redirect('userswebsite/index');
		}
	}

	/*status Active InActive */
// 	public function executeChangeWebsiteStatus(sfWebRequest $request)
// 	{
// 		$snId = $request->getParameter("id");
// 		$ssStatus = $request->getParameter("status");
// 		
// 		$oUsersWebsite = new UsersWebsite();
// 		$oUsersWebsite->changeStatus($snId, $ssStatus);
// 		
// 		if($ssStatus == sfConfig::get("app_Status_Active"))
// 			$successMessage = "activated";
// 		else
// 			$successMessage = "inactivated";
// 
// 		$this->getUser()->setFlash("succMsg",'Website has been '.$successMessage.' successfully ');
// 
// 		$this->redirect('userswebsite/index');
// 	}

	/**
     * Function to view userswebsite
     *
     * @param sfWebRequest $request
     */
	public function executeView(sfWebRequest $request)
	{
		$snId = $request->getParameter("id");
		$oUsersWebsite = new UsersWebsite();
		$asResult = $oUsersWebsite->websiteView($snId);

		$this->form = $asResult[0];
	}
}
