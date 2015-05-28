<?php

/**
 * personalWebsiteFAQs actions.
 *
 * @package    counceledge
 * @subpackage personalWebsiteFAQs
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class personalWebsiteFAQsActions extends sfActions
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
     * Function to personalWebsiteFAQs Listing
     *
     * @param sfWebRequest $request
     */
	public function executeIndex(sfWebRequest $request)
	{
		$this->orderBy = "";
		$this->orderType="";
		$where = "";
		$this->field_type="";
		
		$search_text = '';
		$isSearchBtn = '';

		$oWebsiteXFAQs = new WebsiteXFAQs();
		$qSearch = $oWebsiteXFAQs->personalWebsiteListing();

		$this->objSearchForm = new SearchReplayForm();
		
		if($request->isMethod('post'))
		{
			$websitename = $request->getParameter($this->objSearchForm->getName());
		}
		
		if(!empty($websitename["field_type"]))
		{
			$this->field_type = $websitename["field_type"];
			$qSearch->andWhere("WebsiteId LIKE '%".addslashes($websitename["field_type"])."%'");
		}
		elseif($request->getParameter("field_type"))
		{
			$this->field_type = $request->getParameter("field_type");
			$qSearch->andWhere("WebsiteId LIKE '%".addslashes($request->getParameter("field_type"))."%'");
		}
		$this->objSearchForm->setDefault('field_type', $this->field_type );
			
		/*if($request->getParameter('search_text'))
		$where .="we.name LIKE '%".$request->getParameter('search_text')."%'";
		
		$qSearch->where($where);*/

		switch($request->getParameter('orderBy'))
		{
		case "Question":
			$orderBy = 'Question';
			$this->orderBy = "Question";
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

		$pager = new sfDoctrinePager('WebsiteXFAQs', sfConfig::get('app_no_of_records_per_page'));
		$pager->setQuery($qSearch);
		$pager->setPage($request->getParameter('page', 1));
		$pager->init();
		$this->pager = $pager; 
	}
	
	/**
     * Function to new personalWebsiteFAQs
     *
     * @param sfWebRequest $request
     */
	public function executeNew(sfWebRequest $request)
	{
		$this->form = new WebsiteXFAQsForm();
	}

	/**
     * Function to Create personalWebsiteFAQs
     *
     * @param sfWebRequest $request
     */
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new WebsiteXFAQsForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	/**
     * Function to Edit personalWebsiteFAQs
     *
     * @param sfWebRequest $request
     */
	public function executeEdit(sfWebRequest $request)
	{
		$webId = $request->getParameter('webId');

		$this->webId = $webId;
		$this->forward404Unless($fa_qs = Doctrine::getTable('FAQs')->find(array($request->getParameter('id'))), sprintf('Object fa_qs does not exist (%s).', $request->getParameter('id')));
		$this->form = new FAQsForm($fa_qs,array('webId'=>$webId));

// 		$this->forward404Unless($website_xfa_qs = Doctrine::getTable('WebsiteXFAQs')->find(array($request->getParameter('id'))), sprintf('Object website_xfa_qs does not exist (%s).', $request->getParameter('id')));
// 		$this->form = new WebsiteXFAQsForm($website_xfa_qs);
	}

	/**
     * Function to Update personalWebsiteFAQs
     *
     * @param sfWebRequest $request
     */
	public function executeUpdate(sfWebRequest $request)
	{
		$this->webId =$request->getPostParameter("hiddenWebsiteId");

		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($fa_qs = Doctrine::getTable('FAQs')->find(array($request->getParameter('id'))), sprintf('Object fa_qs does not exist (%s).', $request->getParameter('id')));
		$this->form = new FAQsForm($fa_qs,array('webId'=>$this->webId));

		$this->processForm($request, $this->form);

		$this->setTemplate('edit');
// 		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
// 		$this->forward404Unless($website_xfa_qs = Doctrine::getTable('WebsiteXFAQs')->find(array($request->getParameter('id'))), sprintf('Object website_xfa_qs does not exist (%s).', $request->getParameter('id')));
// 		$this->form = new WebsiteXFAQsForm($website_xfa_qs);
// 
// 		$this->processForm($request, $this->form);
// 
// 		$this->setTemplate('edit');
	}

	/**
     * Function to Delete personalWebsiteFAQs
     *
     * @param sfWebRequest $request
     */
	public function executeDelete(sfWebRequest $request)
	{
		$this->forward404Unless($website_xfa_qs = Doctrine::getTable('WebsiteXFAQs')->find(array($request->getParameter('id'))), sprintf('Object website_xfa_qs does not exist (%s).', $request->getParameter('id')));
		$website_xfa_qs->delete();
		$this->getUser()->setFlash('succMsg', "Deletion successful.");
			
		$this->redirect('personalWebsiteFAQs/index');
	}

	/**
     * Function to Process personalWebsiteFAQs
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$website_xfa_qs = $form->save();

			if($request->isMethod(sfRequest::PUT))
				$this->getUser()->setFlash('succMsg', "Update successful.");
			else 
				$this->getUser()->setFlash('succMsg', "Update successful.");

			$this->redirect('personalWebsiteFAQs/index');

		}
	}
	
	/**
     * Function to Change Status of personalWebsiteFAQs
     *
     * @param sfWebRequest $request
     */
	public function executeChangeStatus(sfWebRequest $request)
	{
		$ssStatus = $request->getParameter("status");
		$snId     = $request->getParameter("id");

		$oWebsiteXFAQs = new WebsiteXFAQs();
		$oWebsiteXFAQs->updateStatusCounceledge($snId,$ssStatus);
		
		if($ssStatus == sfConfig::get("app_Status_Active"))
			$successMessage = "activated";
		else
			$successMessage = "inactivated";

		$this->getUser()->setFlash("succMsg",'Status successfully changed to '.$successMessage.'.');
		
		$this->redirect("personalWebsiteFAQs/index");

	}
	
	/**
     * Function to View personalWebsiteFAQs
     *
     * @param sfWebRequest $request
     */
	public function executeViewPersonalWeb(sfWebRequest $request)
	{
		$snId = $request->getParameter("id");
		$oWebsiteXFAQs = new WebsiteXFAQs();
		$asResult = $oWebsiteXFAQs->viewPersonalWeb($snId);

		$this->form = $asResult;
		$this->setLayout("popup");
	}
}
