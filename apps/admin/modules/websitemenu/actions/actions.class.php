<?php

/**
 * websitemenu actions.
 *
 * @package    counceledge
 * @subpackage websitemenu
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class websitemenuActions extends sfActions
{
	/**
     * Function to Listing the records
     *
     * @param sfWebRequest $request
     */
	public function executeIndex(sfWebRequest $request)
	{
		$this->orderBy = "";
		$this->orderType="";
		$where = "";
		$webId = $this->getUser()->getAttribute('personalWebsiteId');
		
        $oWebsiteMenu = new WebsiteMenu();
        $qSearch = $oWebsiteMenu->websiteMenuListing($webId);

        /* START to display parent name in listing */
		$resutls = $oWebsiteMenu->getParentTitle();
		$asTitle = array();
		foreach($resutls as $resutl)
		{
			$asTitle[$resutl["Id"]] = $resutl["Title"];
			
		}

		$this->asTitle = $asTitle;
		/* END to display parent name in listing */
		
		//$qSearch = Doctrine_Query::create();
		//$qSearch->from('WebsiteMenu we');

		/*if($request->getParameter('search_text'))
		$where .="we.name LIKE '%".$request->getParameter('search_text')."%'";
		
		$qSearch->where($where);*/

		/*switch($request->getParameter('orderBy'))
		{
			case "Title":
				$orderBy = 'Title';
				$this->orderBy = "Title";
				break;
			case "Type":
				$orderBy = 'Type';
				$this->orderBy = "Type";
				break;
			case "CreateDateTime":
				$orderBy = 'CreateDateTime';
				$this->orderBy = "CreateDateTime";
				break;
			default:
				$orderBy = 'id';
				$this->orderBy = "id";
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
		}*/
		
		$pager = new sfDoctrinePager('WebsiteMenu', sfConfig::get('app_no_of_records_per_page'));
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
		$this->form = new WebsiteMenuForm();
	}
	
	/**
     * Function to Create New Record
     *
     * @param sfWebRequest $request
     */
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new WebsiteMenuForm();

		$this->processForm($request, $this->form,false);

		$this->setTemplate('new');
	}

	/**
     * Function to Edit Record
     *
     * @param sfWebRequest $request
     */
	public function executeEdit(sfWebRequest $request)
	{
		if(clsCommon::chkDataExist("WebsiteMenu" ,$request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$this->forward404Unless($website_menu = Doctrine::getTable('WebsiteMenu')->find(array($request->getParameter('id'))), sprintf('Object website_menu does not exist (%s).', $request->getParameter('id')));
			
			$asData = $website_menu->toArray();

			// get the all ids vice versa parent
			$anId = $this->parentchildIds($asData["Id"]);
			$this->form = new WebsiteMenuForm($website_menu,array('Id'=>$anId,'tableType'=>$asData["Type"]));
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
		$this->forward404Unless($website_menu = Doctrine::getTable('WebsiteMenu')->find(array($request->getParameter('id'))), sprintf('Object website_menu does not exist (%s).', $request->getParameter('id')));
		
		$asData = $website_menu->toArray();
		
		$this->form = new WebsiteMenuForm($website_menu,array("Id"=>$asData["Id"],'tableType'=>$asData["Type"]));

		$this->processForm($request, $this->form,true, $asData["ParentId"]);

		$this->setTemplate('edit');
	}

	/**
     * Function to Delete Record
     *
     * @param sfWebRequest $request
     */
	public function executeDelete(sfWebRequest $request)
	{
		if(clsCommon::chkDataExist("WebsiteMenu" ,$request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$website_menu = Doctrine::getTable('WebsiteMenu')->find(array($request->getParameter('id')));
			
			$webId = $website_menu->getWebsiteId();
			$ordering = $website_menu->getOrdering();
			$parentId = $website_menu->getParentId();
			
			$oWebsiteMenu = new WebsiteMenu();
			$oWebsiteMenu->updateOrdrAtMenuDelete($webId, $ordering, $parentId);
			
			/* this delete the recursive record menace chile record also */
			$oWebsiteMenu = new WebsiteMenu();
			$oWebsiteMenu->deleteWebsiteMenu($request->getParameter('id'));

			//$website_menu->delete();
			$this->getUser()->setFlash('succMsg', "Deletion successful.");

			$this->redirect('websitemenu/index');
		}
		else
		{
			$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
			$this->redirect('default/index');
		}
	}

	/**
     * Function to process the insert and update process
     *
     * @param sfWebRequest $request
     */
	protected function processForm(sfWebRequest $request, sfForm $form,$flag, $oldParentId = '')
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		$asData = $request->getParameter($form->getName());
		$webId = $this->getUser()->getAttribute('personalWebsiteId');

		if ($form->isValid())
		{
			if( $asData["Type"] == 1 && $asData["CmsPageId"] == 0 )
			{
				$this->getUser()->setFlash('errCmsMsg', "Please select CmsPage.");
				return false;
			}
			elseif( $asData["Type"] == 2 && $asData["WebsitePracticeAreaId"] == 0 )
			{
				$this->getUser()->setFlash('errCmsMsg', "Please select practice area.");
				return false;
			}

			/* check that title is unique or not */
			$ssCondition = $this->uniqueTitle($webId,$asData,$flag);
			
			/*this is when you create FAQ , Contect,about us at that time this condition use */
			if(!is_bool($ssCondition))
			{
				$this->getUser()->setFlash('errCmsMsg', " Note : Please do not keep title with FAQ, Contact and About US .");
			}
			elseif($ssCondition)
			{
				if( $asData["Type"] == 1 && $asData["CmsPageId"] != 0 )
				{
					unset($form['WebsitePracticeAreaId']);
					$form->getObject()->setCmsPageId($asData["CmsPageId"]);
					$form->getObject()->setWebsitePracticeAreaId(0);
				}
				elseif($asData["Type"] == 2 && $asData["WebsitePracticeAreaId"] != 0 )
				{
					unset($form['CmsPageId']);
					$form->getObject()->setWebsitePracticeAreaId($asData["WebsitePracticeAreaId"]);
					$form->getObject()->setCmsPageId(0);
				}

				$form->getObject()->setParentId($asData["ParentId"]);
				
				if(!$request->isMethod(sfRequest::PUT))
					$form->getObject()->setWebsiteId($webId);

				/* Start check that record is new or if edit then parent id is edit or not */
				if(!$request->isMethod(sfRequest::PUT))
				{
					$oWebsiteMenu = new WebsiteMenu();
					$newOreder = $oWebsiteMenu->maxOrder($webId, $asData["ParentId"]);

					if($newOreder == '')
						$form->getObject()->setOrdering(0);
					else
						$form->getObject()->setOrdering(($newOreder+1));
				}
				elseif($oldParentId != '' && $oldParentId != $asData["ParentId"])
				{
					$oWebsiteMenu = new WebsiteMenu();
					$newOreder = $oWebsiteMenu->maxOrder($webId, $asData["ParentId"]);
					$form->getObject()->setOrdering(($newOreder+1));
				}
				/* End check that record is new or if edit then parent id is edit or not */
				
				$website_menu = $form->save();

				if($request->isMethod(sfRequest::PUT))
					$this->getUser()->setFlash('succMsg', "Update succesful.");
				else 
					$this->getUser()->setFlash('succMsg', "Menu added successfully.");
					
				unset($ssCondition);
				$this->redirect('websitemenu/index');
			}
			else
				$this->getUser()->setFlash('errCmsMsg', "Title already in use, please try again.");
		}
	}

	/* check that title is unique or not */
	/**
     * Function to check that title is unique or not
     *
     * @param Integer  $webId
     * @param array    $asData
     * @param boolean  $flag
     */
	public function uniqueTitle($webId, $asData,$flag)
	{
		/*Start You can not create this type of manus */
// 		if(	$asData["Title"] == "FAQs" || 
// 			$asData["Title"] == "AboutUs" ||
// 			$asData["Title"] == "FAQ" ||
// 			$asData["Title"] == "Contect" ||
// 			$asData["Title"] == "Contects" ||
// 			$asData["Title"] == "aboutus" ||
// 			$asData["Title"] == "about_us" ||
// 			$asData["Title"] == "About_Us" ||
// 			$asData["Title"] == "faq" ||
// 			$asData["Title"] == "faqs" 
// 			)
// 			return "Notice";
		/*End */

		$ssCondition = false;
		$oWebsiteMenu = new WebsiteMenu();
		$asResult = $oWebsiteMenu->checkUniqueTitle($webId, $asData["Title"]);

		if(empty($asResult))
			$ssCondition = true;
		else
		{
			if($flag)
			{
				$oWebsiteMenu = new WebsiteMenu();
				$PersonalResult = $oWebsiteMenu->websitemenuView( $asData["Id"] );
				
				if(strtolower($asData["Title"]) == strtolower($PersonalResult[0]["Title"]))
				{
					$ssCondition = true;
				}
			}
			else
				$ssCondition = false;
		}
		return $ssCondition;
	}

	/**
     * Function to view the record
     *
     * @param sfWebRequest  $request
     */
	public function executeView(sfWebRequest $request)
	{
		$snId = $request->getParameter('id');
		$oWebsiteMenu = new WebsiteMenu();
        $asResult = $oWebsiteMenu->websitemenuView($snId);

        $this->form = $asResult[0];
	}
	
	/* On  ajax call for display parent value in dropdown*/
    public function executeSetParentValue(sfWebRequest $request)
    {
		$webId = $this->getUser()->getAttribute('personalWebsiteId');
        if ($request->isXmlHttpRequest())
        {
			$ssType = $request->getParameter('ssType');
			$snId = $request->getParameter('snId');
			if($ssType != "")
			{
				if($snId == "")
				{
					$anId = 0;
				}
				else
				{
					$anId = $this->parentchildIds($snId);
				}

				/* get the value of parent to fill the combobox */
				$asResultValue = WebsiteMenuTable::getParentValue($webId,$ssType,$anId);
				$output = '<option value=""> Select </option>';
                foreach($asResultValue as $c)
                {
                    $output .= '<option value="'.$c["Id"].'">'.$c["Title"].'</option>';
                }
			}
			else
			{
				$output = '<option value=""> Select </option>';
			}

			return $this->renderText($output);
        }
    }

    /*this function is to vice versa parent not create */
    /**
     * Function to vice versa parent not create
     *
     * @param integer $snId
     */
    public function parentchildIds($snId)
    {
		$webId = $this->getUser()->getAttribute('personalWebsiteId');
		/* Start vice versa parent can not create */
		$oWebsiteMenu = new WebsiteMenu();
		$asResults = $oWebsiteMenu->parentChild($webId, $snId);
		$anId  = array();
		if(!empty($asResults))
		foreach($asResults as $asResult)
		{
			$anId[] = $asResult["Id"];
		}
		/* End  vice versa parent can not create */

		$anId[] = $snId;
		return $anId;
    }
    
    /**
     * Function to ordering of listing
     *
     * @param sfWebRequest $request
     */
    public function executeMenuOrdering(sfWebRequest $request)
    {
		if ($request->isXmlHttpRequest())
        {
			$menuOrdering = $request->getParameter('recordsArray');
			foreach($menuOrdering as $key => $menuOrder)
			{
				$oWebsiteMenu = new WebsiteMenu();
				$oWebsiteMenu->setMenuOrdring($key, $menuOrder);
			}
			
		}
        return sfView::NONE;
    }
}