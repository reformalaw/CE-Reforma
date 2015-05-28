<?php

/**
 * pages actions.
 *
 * @package    counceledge
 * @subpackage pages
 * @author     Chintan Fadia
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pagesActions extends sfActions
{
	/**
	 * display the static page of cmsPages Table
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{	
		$pageName = $request->getParameter('pagename');

		// Get Page Content
		$this->staticPage = Doctrine_Core::getTable('CMSPages')->findOneBySlugAndWebsiteid($pageName, 2);
		
		// If Page Not Found
		$this->forward404Unless($this->staticPage);

		// SETTING PAGE TITLE, KEYWORDS AND DESCRIPTION.
		$this->getResponse()->setTitle('Legal Grip :: '.$this->staticPage->getTitle());
		$this->getResponse()->addMeta('title',$this->staticPage->getMetaTitle());
		$this->getResponse()->addMeta('keywords',$this->staticPage->getMetaKeywords());
		$this->getResponse()->addMeta('description',$this->staticPage->getMetaDescription());
	}

	public function executeContact(sfWebRequest $request)
	{
		#$this->forward('default', 'module');
	}

}