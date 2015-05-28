<?php

/**
 * customeractivity actions.
 *
 * @package    counceledge
 * @subpackage customeractivity
 * @author     Chintan Fadia
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class customeractivityActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        $customerId = $this->getUser()->getAttribute('admin_user_id');

        $qSearch = Doctrine_Query::create();
        $qSearch->from('CaseActivities ca');
        $qSearch->leftJoin('ca.CaseActivitiesCases c');
        $qSearch->where('c.UserId = ? ', $customerId);
        $qSearch->andWhere('ca.ActivityType != ? ', sfConfig::get('app_CaseActivityType_PaymentReceived'));
        $qSearch->andWhere('c.Status = ? ', sfConfig::get('app_CaseStatus_Active'));
        $qSearch->orderBy('ca.Id DESC');


        /*if($request->getP arameter('search_text'))
        $where .="ca.name LIKE '%".$request->getParameter('search_text')."%'";

        $qSearch->where($where);

        switch($request->getParameter('orderBy'))
        {
        case "id":
        $orderBy = 'ca.Id';
        $this->orderBy = "id";
        break;
        case "name":
        default:
        $orderBy = 'ca.Name';
        $this->orderBy = "name";
        break;

        }

        switch($request->getParameter('orderType'))
        {
        case "desc":
        $qSearch->orderBy("$orderBy DESC");
        $this->orderType = "desc";
        break;
        case "asc":
        default:
        $qSearch->orderBy("$orderBy ASC");
        $this->orderType = "asc";
        break;
        }
        */

        // Default Search Array
        $searchArr = array(
        'ActivityType' =>  '' ,
        #'UserCaseNo'   =>  '' ,
        'CaseNo'   =>  '' ,
        'FromDate'     =>  '' ,
        'ToDate'       =>  ''
        );

        // Searching code if Selected from Search then comes here
        if($request->isMethod(sfRequest::POST )) {
            $searchForm = new SearchActivityLoggingForm(array(),array('UserId' =>  $customerId));
            $searchArr = $request->getParameter($searchForm->getName());
            #clsCommon::pr($searchArr);


        } else { // If done through pagination then comes here

            if($request->hasParameter('ActivityType')) {
                $searchArr['ActivityType'] = $request->getParameter('ActivityType');
            }

            /*if($request->hasParameter('UserCaseNo')) {
            $searchArr['UserCaseNo'] = $request->getParameter('UserCaseNo');
            }*/

            if($request->hasParameter('CaseNo')) {
                $searchArr['CaseNo'] = $request->getParameter('CaseNo');
            }

            if($request->hasParameter('FromDate')) {
                $searchArr['FromDate'] = base64_decode($request->getParameter('FromDate'));
            }
            if($request->hasParameter('ToDate')) {
                $searchArr['ToDate'] = base64_decode($request->getParameter('ToDate'));
            }


        } // End of Else

        // Code for Searching Query
        if(!empty($searchArr['ActivityType']))
        $qSearch->andWhere('ca.ActivityType = ? ', $searchArr['ActivityType'] );

        /*if(!empty($searchArr['UserCaseNo'])) {
        $qSearch->andWhere('ca.CaseId = ? ', $searchArr['UserCaseNo'] );
        }*/

        /*if(!empty($searchArr['CaseNo'])) {
            $qSearch->andWhere('c.CaseNo LIKE ? ', '%'.$searchArr['CaseNo'].'%' );
        }*/

        if(!empty($searchArr['CaseNo'])) {
            $temp = explode(" ",$searchArr['CaseNo']);
            $qSearch->andWhere('c.CaseNo LIKE ? ', '%'.$temp[0].'%' );
        }

        if(!empty($searchArr['FromDate']) && !empty($searchArr['ToDate'])) {
            $fromDT = date('Y-m-d', strtotime($searchArr['FromDate']));
            $toDT = date('Y-m-d', strtotime($searchArr['ToDate']));
            $qSearch->andWhere('DATE_FORMAT(ca.CreateDateTime, "%Y-%m-%d") BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            #$qSearch->andWhere('DATE_FORMAT(ca.CreateDateTime, "%m/%d/%Y") BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            //DATE_FORMAT(date,format)
        }
        // Code of Search query completes

        $defaultArr =  array(
        'ActivityType'  =>  $searchArr['ActivityType'] ,
        #'UserCaseNo'    =>  $searchArr['UserCaseNo'] ,
        'CaseNo'        =>  $searchArr['CaseNo'] ,
        'FromDate'      =>  $searchArr['FromDate'] ,
        'ToDate'        =>  $searchArr['ToDate'] ,
        );

        /**
         *  THE FOLLOWING CODE IS USE FOR AUTO SUGGEST OF CASE NO.
         */
        if ($request->getParameter('term')){

            //sleep( 1 );
            $q = strtolower($request->getParameter('term'));
            // remove slashes if they were magically added
            if (get_magic_quotes_gpc()) $q = stripslashes($q);

            $items = clsCommon::autoSuggestDashboardCaseNo($customerId);

            $result = array();
            foreach ($items as $key=>$value) {
                if (strpos(strtolower($key), $q) !== false) {
                    array_push($result, array("id"=>$value, "label"=>$value, "value" => strip_tags($value)));
                }
                if (count($result) > 11)
                break;
            }

            // json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
            echo json_encode($result);
            exit;
        } //END OF AUTO SUGGEST

        // Search Form
        $searchForm = new SearchActivityLoggingForm(array(),array('UserId' =>  $customerId));
        $this->searchForm = $searchForm ;

        $this->defaultArr = $defaultArr;
        $this->searchForm->setDefaults($defaultArr) ;

        $pager = new sfDoctrinePager('CaseActivities', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    }
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new CaseActivitiesForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new CaseActivitiesForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($case_activities = Doctrine::getTable('CaseActivities')->find(array($request->getParameter('id'))), sprintf('Object case_activities does not exist (%s).', $request->getParameter('id')));
        $this->form = new CaseActivitiesForm($case_activities);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($case_activities = Doctrine::getTable('CaseActivities')->find(array($request->getParameter('id'))), sprintf('Object case_activities does not exist (%s).', $request->getParameter('id')));
        $this->form = new CaseActivitiesForm($case_activities);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();

        $this->forward404Unless($case_activities = Doctrine::getTable('CaseActivities')->find(array($request->getParameter('id'))), sprintf('Object case_activities does not exist (%s).', $request->getParameter('id')));
        $case_activities->delete();

        $this->redirect('customeractivity/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $case_activities = $form->save();

            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "New case activities added successfully.");

            $this->redirect('customeractivity/index');
            //$this->redirect('customeractivity/edit?id='.$case_activities->getId());
        }
    }
}
