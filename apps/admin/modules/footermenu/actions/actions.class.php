<?php

/**
 * footermenu actions.
 *
 * @package    counceledge
 * @subpackage footermenu
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class footermenuActions extends sfActions
{
	/**
	 * Listing Of Footer Menu
	 *
	 * @param sfRequest $request
	 */
	public function executeIndex(sfWebRequest $request)
	{
		$this->orderBy = "";
		$this->orderType="";
		$where = "";
		$webId = $this->getUser()->getAttribute('personalWebsiteId');
		
        $qSearch = WebsiteMenuTable::getFooterList($webId);

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
		$this->form = new FooterMenuForm();
	}
	
	/**
     * Function to Create New Record
     *
     * @param sfWebRequest $request
     */
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new FooterMenuForm();

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
			$this->forward404Unless($footerMenu = Doctrine::getTable('WebsiteMenu')->find(array($request->getParameter('id'))), sprintf('Object website_menu does not exist (%s).', $request->getParameter('id')));
			$this->form = new FooterMenuForm($footerMenu);
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
		$this->forward404Unless($footerMenu = Doctrine::getTable('WebsiteMenu')->find(array($request->getParameter('id'))), sprintf('Object website_menu does not exist (%s).', $request->getParameter('id')));
		
		$this->form = new FooterMenuForm($footerMenu);

		$this->processForm($request, $this->form,true);

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
			$footerMenu = Doctrine::getTable('WebsiteMenu')->find(array($request->getParameter('id')));
			
			$webId = $footerMenu->getWebsiteId();
			$ordering = $footerMenu->getOrdering();
			
			$oWebsiteMenu = new WebsiteMenu();
			$oWebsiteMenu->updateOrdrAtFooterDelete($webId, $ordering);
			
			$footerMenu->delete();
			$this->getUser()->setFlash('succMsg', "Deletion successful.");

			$this->redirect('footermenu/index');
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
	protected function processForm(sfWebRequest $request, sfForm $form,$flag)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		$asData = $request->getParameter($form->getName());
		$webId = $this->getUser()->getAttribute('personalWebsiteId');

		if ($form->isValid())
		{
			if( $asData["Type"] == 1 && $asData["CmsPageId"] == 0 )
			{
				$this->getUser()->setFlash('errCmsMsg', "Please select cmspage.");
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
				$this->getUser()->setFlash('errCmsMsg', " Note : Please do not keep title with FAQ, Contact and About US.");
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

				$form->getObject()->setParentId(0);
				$form->getObject()->setMenuType(sfConfig::get("app_MenuType_Footer"));
				
				if(!$request->isMethod(sfRequest::PUT))
				{
					$form->getObject()->setWebsiteId($webId);

					$newOreder = WebsiteMenuTable::maxFooterMenuOrder($webId);

					if($newOreder == '')
						$form->getObject()->setOrdering(0);
					else
						$form->getObject()->setOrdering(($newOreder+1));
				}

				$website_menu = $form->save();

				if($request->isMethod(sfRequest::PUT))
					$this->getUser()->setFlash('succMsg', "Update successful.");
				else 
					$this->getUser()->setFlash('succMsg', "Footer menu added successfully.");
					
				unset($ssCondition);
				$this->redirect('footermenu/index');
			}
			else
				$this->getUser()->setFlash('errCmsMsg', "Title already in use, please try again. ");
		}
	}
	
	/**
     * Function to check that title is unique or not
     *
     * @param Integer  $webId
     * @param array    $asData
     * @param boolean  $flag
     */
	public function uniqueTitle($webId, $asData,$flag)
	{
		$ssCondition = false;
		$asResult = WebsiteMenuTable::checkFooterUniqueTitle($webId, $asData["Title"]);

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
     * Function to ordering of listing
     *
     * @param sfWebRequest $request
     */
    public function executeFooterMenuOrdering(sfWebRequest $request)
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