<?php

/**
 * statistics actions.
 *
 * @package    counceledge
 * @subpackage statistics
 * @author     Krunal Nerikar
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class statisticsActions extends sfActions
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

    public function executeIndex(sfWebRequest $request)
    {
        $this->statisticsDetail = StatisticsTable::getDaysStatistics(1);
    }
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new StatisticsForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new StatisticsForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($statistics = Doctrine::getTable('Statistics')->find(array($request->getParameter('id'))), sprintf('Object statistics does not exist (%s).', $request->getParameter('id')));
        $this->form = new StatisticsForm($statistics);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($statistics = Doctrine::getTable('Statistics')->find(array($request->getParameter('id'))), sprintf('Object statistics does not exist (%s).', $request->getParameter('id')));
        $this->form = new StatisticsForm($statistics);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();

        $this->forward404Unless($statistics = Doctrine::getTable('Statistics')->find(array($request->getParameter('id'))), sprintf('Object statistics does not exist (%s).', $request->getParameter('id')));
        $statistics->delete();

        $this->redirect('statistics/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $statistics = $form->save();

            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "New statistics added successfully.");

            $this->redirect('statistics/index');
            //$this->redirect('statistics/edit?id='.$statistics->getId());
        }
    }

    /* Action for update statistics graph according to select button (7 Days, 1 Month, 6 Months )*/
    public function executeUpdateStatisticsGraph(sfWebRequest $request)
    {
        if($request->getParameter('BtnDay') && $request->getParameter('DayType')){
            $BtnDays = $request->getParameter('BtnDay');
            $DayType = $request->getParameter('DayType');

            if($request->hasParameter('webId'))
				$webId = $request->getParameter('webId');
            elseif($request->hasParameter('customerId'))
				$customerId = $request->getParameter('customerId');
        }
        else{
            $BtnDays = '1';
            $DayType = 'DAY';
        }

        if($request->hasParameter('webId'))
			$this->statisticsDetail = StatisticsTable::getDaysStatistics($webId, $BtnDays,$DayType);
        elseif($request->hasParameter('customerId'))
        {
			if($request->hasParameter('flag'))
			{
				if($request->getParameter('flag') == "contact")
					$this->statisticsDetail = AttorneyStatisticsTable::getContactStatistics($customerId, $BtnDays,$DayType);
			}
			else
			{
				$this->statisticsDetail = AttorneyStatisticsTable::getProfileStatistics($customerId, $BtnDays,$DayType);
			}
        }
        //echo "<pre>"; print_r($this->statisticsDetail); exit;
    }

    /**
	 * Function is use for legalgrip statistics
	 *
	 * @param sfRequest $request A request object
	 */
    public function executeLigalgripStatistics(sfWebRequest $request)
    {
        $this->statisticsDetail = StatisticsTable::getDaysStatistics(2);

    }

    /**
	 * Function is use for website statistics
	 *
	 * @param sfRequest $request A request object
	 */
    public function executeWebsiteStatistics(sfWebRequest $request)
    {
        $this->statisticsDetail = StatisticsTable::getDaysStatistics();
        $this->form = new SearchStatisticsForm();
    }

    /**
	 * Function is use for customer profile statistics
	 *
	 * @param sfRequest $request A request object
	 */
    public function executeProfileStatistics(sfWebRequest $request)
    {
        $this->statisticsDetail = AttorneyStatisticsTable::getProfileStatistics();
 
        if ($request->getParameter('term')){

            $q = strtolower($request->getParameter('term'));
            // remove slashes if they were magically added
            if (get_magic_quotes_gpc()) $q = stripslashes($q);

            $items = clsCommon::autoSuggestCustomerName();

            $result = array();
            foreach ($items as $key=>$value) {
                if (strpos(strtolower($value), $q) !== false) {
                    array_push($result, array("id"=>$key, "label"=>$value, "value" => strip_tags($value)));
                }
                if (count($result) > 11)
                break;
            }
            // json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
            echo json_encode($result);
            exit;
        } //END OF AUTO SUGGEST
    }

	/**
	 * Function is use for customer Contact statistics
	 *
	 * @param sfRequest $request A request object
	 */
    public function executeContactStatistics(sfWebRequest $request)
    {
		$this->statisticsDetail = AttorneyStatisticsTable::getContactStatistics();

        if ($request->getParameter('term')){

            $q = strtolower($request->getParameter('term'));
            // remove slashes if they were magically added
            if (get_magic_quotes_gpc()) $q = stripslashes($q);

            $items = clsCommon::autoSuggestCustomerName();

            $result = array();
            foreach ($items as $key=>$value) {
                if (strpos(strtolower($value), $q) !== false) {
                    array_push($result, array("id"=>$key, "label"=>$value, "value" => strip_tags($value)));
                }
                if (count($result) > 11)
                break;
            }
            // json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
            echo json_encode($result);
            exit;
        } //END OF AUTO SUGGEST
    }

}