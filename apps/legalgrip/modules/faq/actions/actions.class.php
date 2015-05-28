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
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		$qSearch = WebsiteXFAQsTable::legalgripListing(2);
        $this->ligalgripList = $qSearch->execute();
	}
}
