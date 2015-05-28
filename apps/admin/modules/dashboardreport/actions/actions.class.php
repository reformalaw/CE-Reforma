<?php

/**
 * dashboardreport actions.
 *
 * @package    counceledge
 * @subpackage dashboardreport
 * @author     Chintan Fadia
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dashboardreportActions extends sfActions
{

    /**
	 * preExecutes index action
	 */
    public function preExecute()
    {
        $this->setLayout("dashboard");
        $request = $this->getRequest();
        $this->customerId = $request->getParameter('customerId');

        if($this->customerId != "")
        {
            $userData = Doctrine::getTable('Users')->find(array($request->getParameter('customerId')));
            if($userData->getUserType() != sfConfig::get("app_UserType_Customer")  || $userData->getBillingSubscription() == "No") //|| $userData->getStatus() == sfConfig::get("app_UserStatus_Pending")
            $this->redirect("users/index");
        }
        else
        $this->redirect("users/index");
    }

    /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {

        $this->customerId = $request->getParameter('customerId');
        $qSearch = Doctrine_Query::create();
        $qSearch->from('Cases ca');
        $qSearch->whereIn('ca.Stage', array(sfConfig::get('app_CaseStage_Accepted'), sfConfig::get('app_CaseStage_Paid'), sfConfig::get('app_CaseStage_Close')));
        $qSearch->andWhereIn('ca.Status', array(sfConfig::get('app_CaseStatus_Active'), sfConfig::get('app_CaseStatus_Inactive')));
        $qSearch->andWhere('ca.CaseNo != ? ', '' );
        $qSearch->andWhere('ca.UserId = ? ', $this->customerId );
        $qSearch->orderBy('ca.CreateDateTime DESC' );

        # THE BELOW LINE IS USE FOR FETCHGING THE NAME OF CUSTOMER.
        $this->name = Doctrine_Core::getTable('Users')->findOneBy('Id',$request->getParameter('customerId'));

        // Default Search Array
        $searchArr = array(
        #'UserCaseNo'      =>  '' ,
        'CaseNo'      =>  '' ,
        'StartAmount' =>  '' ,
        'EndAmount'   =>  '' ,
        'Stage'       =>  '' ,
        'FromDate'    =>  '' ,
        'ToDate'      =>  ''
        );

        // Searching code if Selected from Search then comes here
        if($request->isMethod(sfRequest::POST )) {
            $searchForm = new PaymentReportForm(array(),array('userId'=> $this->customerId));
            $searchArr = $request->getParameter($searchForm->getName());
        } else { // If done through pagination then comes here

            /*if($request->hasParameter('UserCaseNo')) {
            $searchArr['UserCaseNo'] = $request->getParameter('UserCaseNo');
            }*/

            if($request->hasParameter('CaseNo')) {
                $searchArr['CaseNo'] = $request->getParameter('CaseNo');
            }

            if($request->hasParameter('StartAmount') && $request->hasParameter('EndAmount')) {
                $searchArr['StartAmount'] = $request->getParameter('StartAmount');
                $searchArr['EndAmount'] = $request->getParameter('EndAmount');
            }

            if($request->hasParameter('Stage')) {
                $searchArr['Stage'] = $request->getParameter('Stage');
            }


            if($request->hasParameter('FromDate')) {
                $searchArr['FromDate'] = base64_decode($request->getParameter('FromDate'));
            }
            if($request->hasParameter('ToDate')) {
                $searchArr['ToDate'] = base64_decode($request->getParameter('ToDate'));
            }


        } // End of Else

        // Code for Searching Query
        /*if(!empty($searchArr['UserCaseNo'])) {
        $caseArr = CasesTable::getAllCaseNo();
        #echo $caseArr[$searchArr['UserCaseNo']];
        $qSearch->andWhere('ca.CaseNo = ? ', $caseArr[$searchArr['UserCaseNo']] );
        }*/

        /*if(!empty($searchArr['CaseNo'])) {
        $qSearch->andWhere('ca.CaseNo LIKE ? ', '%'.$searchArr['CaseNo'].'%' );
        }*/

        if(!empty($searchArr['CaseNo'])) {
            $temp = explode(" ",$searchArr['CaseNo']);
            $qSearch->andWhere('ca.CaseNo LIKE ? ', '%'.$temp[0].'%' );
        }

        if($searchArr['StartAmount'] != ''  && $searchArr['EndAmount'] != '') {
            $qSearch->andWhere('ca.ActualAmount BETWEEN ? AND ? ', array(trim($searchArr['StartAmount']) , trim($searchArr['EndAmount']))  );
        }

        if(!empty($searchArr['Stage'])) {
            $qSearch->andWhere('ca.Stage = ? ', $searchArr['Stage'] );
        }

        if(!empty($searchArr['FromDate']) && !empty($searchArr['ToDate'])) {
            $fromDT = date('Y-m-d',strtotime($searchArr['FromDate']));
            $toDT =  date('Y-m-d',strtotime($searchArr['ToDate']));
            $qSearch->andWhere('ca.AgreementDate BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            #$qSearch->andWhere('DATE_FORMAT(ca.AgreementDate, "%m/%d/%Y") BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            //DATE_FORMAT(date,format)
        }


        // Code of Search query completes
        $defaultArr =  array(
        #'UserCaseNo'  =>  $searchArr['UserCaseNo'] ,
        'CaseNo'      =>  $searchArr['CaseNo'] ,
        'StartAmount' => ( ($searchArr['StartAmount'] != '' && $searchArr['EndAmount'] != '' ) ? $searchArr['StartAmount'] : '') ,
        'EndAmount'   => ( ($searchArr['StartAmount'] != '' && $searchArr['EndAmount'] != '' ) ? $searchArr['EndAmount'] : ''),
        'FromDate'    =>  $searchArr['FromDate'] ,
        'ToDate'      =>  $searchArr['ToDate'] ,
        'Stage'       =>  $searchArr['Stage'] ,

        );
        #clsCommon::pr($defaultArr);

        /**
         *  THE FOLLOWING CODE IS USE FOR AUTO SUGGEST OF CASE NO.
         */
        if ($request->getParameter('term')){

            //sleep( 1 );
            $q = strtolower($request->getParameter('term'));
            // remove slashes if they were magically added
            if (get_magic_quotes_gpc()) $q = stripslashes($q);

            $items = clsCommon::autoSuggestDashboardCaseNo($request->getParameter('customerId'));

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

        // Search Form for customer Payment Report Form
        $searchForm = new PaymentReportForm(array(),array('userId'=> $this->customerId));
        $this->searchForm = $searchForm ;

        $this->defaultArr = $defaultArr;
        $this->searchForm->setDefaults($defaultArr) ;

        #echo $qSearch;
        $pager = new sfDoctrinePager('Cases', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

        // Customer Statistics
        #echo $userId;
        $this->totalAcceptedCasesCount = CasesTable::GetCustomerAcceptedCaseCount($this->customerId);
        #$this->totalPaidCasesCount = CasesTable::GetCustomerPaidCaseCount($this->customerId);
        #$this->totalPendingCasesCount = CasesTable::GetCustomerPendingCaseCount($this->customerId);
        $this->totalCasesAmount = CasesTable::GetCustomerCaseAllAmount($this->customerId);
        $this->totalDifferenceAmount = CasesTable::GetCaseDifferenceAmount($this->customerId);

        // Statistics for Search
        #clsCommon::pr($searchArr);
        #$searchStatistics = CasesTable::GetCaseSearchStatistics($searchArr);


    }

    /**
   * Customer Report, Customer Under Payment Report
   *
   * @param sfWebRequest $request
   */
    public function executeUnderpay(sfWebRequest $request)
    {

        $this->customerId = $request->getParameter('customerId');
        $qSearch = Doctrine_Query::create();
        $qSearch->from('Cases ca');
        $qSearch->where('ca.Stage = ? ', sfConfig::get('app_CaseStage_Close'));
        $qSearch->andWhereIn('ca.Status',  array(sfConfig::get('app_CaseStatus_Active'), sfConfig::get('app_CaseStatus_Inactive')));
        $qSearch->andWhere('ca.DifferenceAmount != ? ', "");
        $qSearch->andWhere('ca.UserId = ? ', $this->customerId);
        $qSearch->orderBy('ca.CreateDateTime DESC' );

        #echo $qSearch;
        $pager = new sfDoctrinePager('Cases', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

    } // End of Function

}
