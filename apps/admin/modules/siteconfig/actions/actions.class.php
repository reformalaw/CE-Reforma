<?php

/**
 * siteconfig actions.
 *
 * @package    counceledge
 * @subpackage siteconfig
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class siteconfigActions extends sfActions
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
     * Function to Listing siteconfig
     *
     * @param sfWebRequest $request
     */
	public function executeIndex(sfWebRequest $request)
	{
		$this->orderBy = "";
		$this->orderType="";
		$where = "";

		$oSiteConfig = new SiteConfig();
		$qSearch = $oSiteConfig->siteconfigListing();

		switch($request->getParameter('orderBy'))
		{
			case "ConfigKey":
				$orderBy = 'ConfigKey';
				$this->orderBy = "ConfigKey";
				break;
			case "UpdateDateTime":
				$orderBy = 'UpdateDateTime';
				$this->orderBy = "UpdateDateTime";
				break;
			default:
				$orderBy = 'UpdateDateTime';
				$this->orderBy = "UpdateDateTime";
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

		$this->pager = $qSearch->execute();
	}

	/**
     * Function to New siteconfig
     *
     * @param sfWebRequest $request
     */
	public function executeNew(sfWebRequest $request)
	{
		$this->form = new SiteConfigForm();
	}

	/**
     * Function to Create siteconfig
     *
     * @param sfWebRequest $request
     */
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new SiteConfigForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	/**
     * Function to Edit siteconfig
     *
     * @param sfWebRequest $request
     */
	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404Unless($site_config = Doctrine::getTable('SiteConfig')->find(array($request->getParameter('config_key'))), sprintf('Object site_config does not exist (%s).', $request->getParameter('config_key')));
		$this->ssConfigkey = $site_config->getConfigKey();
		$this->form = new SiteConfigForm($site_config);
	}

	/**
     * Function to Update siteconfig
     *
     * @param sfWebRequest $request
     */
	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($site_config = Doctrine::getTable('SiteConfig')->find(array($request->getParameter('config_key'))), sprintf('Object site_config does not exist (%s).', $request->getParameter('config_key')));
		$this->ssConfigkey = $site_config->getConfigKey();
		$this->form = new SiteConfigForm($site_config);

		$this->processForm($request, $this->form);

		$this->setTemplate('edit');
	}

	/**
     * Function to Delete siteconfig
     *
     * @param sfWebRequest $request
     */
	public function executeDelete(sfWebRequest $request)
	{
		$this->forward404Unless($site_config = Doctrine::getTable('SiteConfig')->find(array($request->getParameter('config_key'))), sprintf('Object site_config does not exist (%s).', $request->getParameter('config_key')));
		$site_config->delete();

		$this->redirect('siteconfig/index');
	}

	/**
     * Function to Process Form of siteconfig
     *
     * @param sfWebRequest $request
     */
	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$site_config = $form->save();

			if($request->isMethod(sfRequest::PUT))
				$this->getUser()->setFlash('succMsg', "Update successful.");
			else 
				$this->getUser()->setFlash('succMsg', " New site config variable added successfully.");

			$this->redirect('siteconfig/index');
		}
	}
}
