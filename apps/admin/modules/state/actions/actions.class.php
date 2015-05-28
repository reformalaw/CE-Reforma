<?php

/**
 * state actions.
 *
 * @package    counceledge
 * @subpackage state
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stateActions extends sfActions
{
	/**
     * Function to Listing the states
     *
     * @param sfWebRequest $request
     */
	public function executeIndex(sfWebRequest $request)
	{
		$this->orderBy = "";
		$this->orderType="";
		$where = "";

		$qSearch = Doctrine_Query::create();
		$qSearch->from('States st');
		$qSearch->where("st.CountryId = ?",sfConfig::get('app_State_UsStateId'));
		$qSearch->orderBy("Name Asc");
		
		$pager = new sfDoctrinePager('States', sfConfig::get('app_no_of_records_per_page'));
		$pager->setQuery($qSearch);
		$pager->setPage($request->getParameter('page', 1));
		$pager->init();
		$this->pager = $pager; 
	}

	/**
     * Function to add state
     *
     * @param sfWebRequest $request
     */
	public function executeNew(sfWebRequest $request)
	{
		$this->form = new StatesForm();
	}

	/**
     * Function to create state
     *
     * @param sfWebRequest $request
     */
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new StatesForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	/**
     * Function to Edit state
     *
     * @param sfWebRequest $request
     */
	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404Unless($states = Doctrine::getTable('States')->find(array($request->getParameter('id'))), sprintf('Object states does not exist (%s).', $request->getParameter('id')));
		$this->form = new StatesForm($states);
	}

	/**
     * Function to Update state
     *
     * @param sfWebRequest $request
     */
	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($states = Doctrine::getTable('States')->find(array($request->getParameter('id'))), sprintf('Object states does not exist (%s).', $request->getParameter('id')));
		$this->form = new StatesForm($states);

		$this->processForm($request, $this->form);

		$this->setTemplate('edit');
	}

	/**
     * Function to Delete state
     *
     * @param sfWebRequest $request
     */
	public function executeDelete(sfWebRequest $request)
	{
		$this->forward404Unless($states = Doctrine::getTable('States')->find(array($request->getParameter('id'))), sprintf('Object states does not exist (%s).', $request->getParameter('id')));
		$states->delete();
		$this->getUser()->setFlash('succMsg', "Deletion successful.");
		$this->redirect('state/index');
	}

	/**
     * Function to process the form
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
				$flag = false;

			$ssCondition = $this->uniqueName($asData, $flag);

			if($ssCondition)
			{
				$form->getObject()->setCountryId(sfConfig::get('app_State_UsStateId'));
				$form->getObject()->setStatus('Active');

				$states = $form->save();
				if($request->isMethod(sfRequest::PUT))
					$this->getUser()->setFlash('succMsg', "Update successful.");
				else 
					$this->getUser()->setFlash('succMsg', "State added successfully.");

				$this->redirect('state/index');
			}
			else
			{
				$this->getUser()->setFlash('errMsg', "State name already in use, please try again. ",false);
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
		
		$asResult = StatesTable::checkUniqueName($asData["Name"]);

		if(empty($asResult))
			$ssCondition = true;
		else
		{
			if($flag)
			{
				$PersonalResult = Doctrine::getTable('States')->find(array($asData["Id"]));

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