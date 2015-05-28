<?php

/**
 * counties actions.
 *
 * @package    counceledge
 * @subpackage counties
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class countiesActions extends sfActions
{
	/**
     * Function to listing counties
     *
     * @param sfWebRequest $request
     */
	public function executeIndex(sfWebRequest $request)
	{
		$this->orderBy = "";
        $this->orderType="";
		$this->searchBy = "";
		$where = "";
		$this->id = "";

		$qSearch = Doctrine_Query::create();
		$qSearch->from('Counties co');
		$qSearch->where('co.Status = ?', sfConfig::get('app_UserStatus_Active'));
		

		if($request->hasParameter('id'))
		{
			if($request->getParameter('id') != "")
			{
				$this->searchBy = $request->getParameter('id');
				$qSearch->andWhere("co.StateId = ?", $this->searchBy);
				$this->id = $request->getParameter('id');
			}
		}

		$this->searchForm = new SearchCountiesForm();
		if($request->isMethod(sfRequest::POST )) {
				$searchForm = new SearchCountiesForm();
				$searchStateId = $request->getParameter($searchForm->getName());
				
				if($searchStateId["searchbystate"] != "" && $searchStateId["searchbystate"] != '0')
				{
					$this->searchBy = $searchStateId["searchbystate"];
					$qSearch->andWhere("co.StateId = ?", $searchStateId["searchbystate"]);
				}
		}
		else
		{
			if($request->getParameter('searchBy') != '')
			{
				$searchBy = $this->searchBy = $request->getParameter('searchBy');
				$qSearch->andWhere("co.StateId = ?", $searchBy);
			}
		}

		$pager = new sfDoctrinePager('Counties', sfConfig::get('app_no_of_records_per_page'));
		$pager->setQuery($qSearch);
		$pager->setPage($request->getParameter('page', 1));
		$pager->init();
		$this->pager = $pager; 
	}
	
	/**
     * Function to new counties
     *
     * @param sfWebRequest $request
     */
	public function executeNew(sfWebRequest $request)
	{
		$this->form = new CountiesForm();
	}

	/**
     * Function to Create counties
     *
     * @param sfWebRequest $request
     */
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new CountiesForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	/**
     * Function to Edit counties
     *
     * @param sfWebRequest $request
     */
	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404Unless($counties = Doctrine::getTable('Counties')->find(array($request->getParameter('id'))), sprintf('Object counties does not exist (%s).', $request->getParameter('id')));
		$this->form = new CountiesForm($counties, array('Id'=>$request->getParameter('id')));
	}

	/**
     * Function to update counties
     *
     * @param sfWebRequest $request
     */
	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($counties = Doctrine::getTable('Counties')->find(array($request->getParameter('id'))), sprintf('Object counties does not exist (%s).', $request->getParameter('id')));
		$this->form = new CountiesForm($counties, array('Id'=>$request->getParameter('id')));

		$this->processForm($request, $this->form);

		$this->setTemplate('edit');
	}

	/**
     * Function to delete form
     *
     * @param sfWebRequest $request
     */
	public function executeDelete(sfWebRequest $request)
	{
		$this->forward404Unless($counties = Doctrine::getTable('Counties')->find(array($request->getParameter('id'))), sprintf('Object counties does not exist (%s).', $request->getParameter('id')));
		$counties->delete();

		$this->redirect('counties/index');
	}

	/**
     * Function to process form
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		$asData = $request->getParameter($form->getName());

		if ($form->isValid())
		{
		
			if($request->isMethod(sfRequest::PUT))
				$flag = true;
			else
				$flag= false;

			$ssCondition = $this->uniqueName($asData, $flag);
			
			if($ssCondition)
			{
				$counties = $form->save();
				
				if($request->isMethod(sfRequest::PUT))
					$this->getUser()->setFlash('succMsg', "Update successful.");
				else 
					$this->getUser()->setFlash('succMsg', "County added successfully.");

				$this->redirect('counties/index');
			}
			else
			{
				$this->getUser()->setFlash('errMsg', "County name already in use, please try again.",false);
			}
		}
	}
	
	/**
     * Function to check unique state name
     *
     * @param array $asData
     * @param boolean $flag
     */
	public function uniqueName($asData, $flag)
	{
		$ssCondition = false;
		
		$asResult = CountiesTable::checkUniqueCountiesName($asData["Name"], $asData["StateId"]);

		if(empty($asResult))
			$ssCondition = true;
		else
		{
			if($flag)
			{
				$PersonalResult = Doctrine::getTable('Counties')->find(array($asData["Id"]));

				if(strtolower($asData["Name"]) == strtolower($PersonalResult->getName()))
				{
					$ssCondition = true;
				}
			}
			else
				$ssCondition = false;
		}
		return $ssCondition;
	}
}