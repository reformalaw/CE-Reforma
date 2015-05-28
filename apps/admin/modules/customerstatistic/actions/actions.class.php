<?php

/**
 * customerstatistic actions.
 *
 * @package    counceledge
 * @subpackage customerstatistic
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class customerstatisticActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		//$this->forward('default', 'module');
	}

	/**
	 * Function is use for customer profile statistics
	 *
	 * @param sfRequest $request A request object
	 */
    public function executeCustomerProfileStatistics(sfWebRequest $request)
    {
		$customerId = $this->getUser()->getAttribute('admin_user_id');
        $this->statisticsDetail = AttorneyStatisticsTable::getProfileStatistics($customerId);
    }
    /**
	 * Function is use for customer Contact statistics
	 *
	 * @param sfRequest $request A request object
	 */
    public function executeCustomerContactStatistics(sfWebRequest $request)
    {
		$customerId = $this->getUser()->getAttribute('admin_user_id');
		$this->statisticsDetail = AttorneyStatisticsTable::getContactStatistics($customerId);

    }

    /* Action for update statistics graph according to select button (7 Days, 1 Month, 6 Months )*/
    public function executeUpdateStatisticsGraph(sfWebRequest $request)
    {
		$customerId = $this->getUser()->getAttribute('admin_user_id');
        if($request->getParameter('BtnDay') && $request->getParameter('DayType')){
            $BtnDays = $request->getParameter('BtnDay');
            $DayType = $request->getParameter('DayType');
        }
        else{
            $BtnDays = '1';
            $DayType = 'DAY';
        }

        if($request->hasParameter('flag'))
        {
			if($request->getParameter('flag') == "contact")
			{
				$this->statisticsDetail = AttorneyStatisticsTable::getContactStatistics($customerId, $BtnDays,$DayType);
			}
		}
		else
			$this->statisticsDetail = AttorneyStatisticsTable::getProfileStatistics($customerId, $BtnDays,$DayType);

    }

    public function executeWebsiteStatistics(sfWebRequest $request)
    {
		$this->webId = $webId = $this->getUser()->getAttribute('personalWebsiteId');
		$this->statisticsDetail = StatisticsTable::getDaysStatistics($webId);
    }

    public function executeUpdateWebsiteStatisticsGraph(sfWebRequest $request)
    {
		if($request->getParameter('BtnDay') && $request->getParameter('DayType')){
            $BtnDays = $request->getParameter('BtnDay');
            $DayType = $request->getParameter('DayType');

            $webId = "";
            if($request->hasParameter('webId'))
				$webId = $request->getParameter('webId');
        }
        else{
            $BtnDays = '1';
            $DayType = 'DAY';
        }

        if($request->hasParameter('webId'))
			$this->statisticsDetail = StatisticsTable::getDaysStatistics($webId, $BtnDays,$DayType);
    }
}