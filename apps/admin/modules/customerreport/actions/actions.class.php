<?php

/**
 * customerreport actions.
 *
 * @package    counceledge
 * @subpackage customerreport
 * @author     Chintan Fadia
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class customerreportActions extends sfActions
{
    /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {
        $this->forward('default', 'module');
    }

    /**
   * Customer Report, Customer Paid cases Payment Report
   *
   * @param sfWebRequest $request
   */
    public function executePaymentReport(sfWebRequest $request)
    {
        $userId = $this->getUser()->getAttribute('admin_user_id');
        $qSearch = Doctrine_Query::create();
        $qSearch->from('Cases ca');
        $qSearch->whereIn('ca.Stage', array( sfConfig::get('app_CaseStage_Accepted'), sfConfig::get('app_CaseStage_Paid'), sfConfig::get('app_CaseStage_Close')));
        $qSearch->andWhere('ca.Status = ? ', sfConfig::get('app_CaseStatus_Active'));
        $qSearch->andWhere('ca.CaseNo != ? ', '' );
        $qSearch->andWhere('ca.UserId = ? ', $userId );
        $qSearch->orderBy('ca.CreateDateTime DESC' );


        // Default Search Array
        $searchArr = array(
        #'UserCaseNo'      =>  '' ,
        'CaseNo'      =>  '' ,
        'StartAmount' =>  '' ,
        'EndAmount'   =>  '' ,
        'FromDate'    =>  '' ,
        'ToDate'      =>  ''
        );

        // Searching code if Selected from Search then comes here
        if($request->isMethod(sfRequest::POST )) {
            $searchForm = new PaymentReportForm(array(),array('userId'=> $userId));
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
        
/*        if(!empty($searchArr['StartAmount'] ) && !empty($searchArr['EndAmount'] )) { echo 'eee';
            $qSearch->andWhere('ca.ActualAmount BETWEEN ? AND ? ', array(trim($searchArr['StartAmount']) , trim($searchArr['EndAmount']))  );
        }*/


        if($searchArr['StartAmount'] != '' && $searchArr['EndAmount'] != '') { 
            $qSearch->andWhere('ca.ActualAmount BETWEEN ? AND ? ', array(trim($searchArr['StartAmount']) , trim($searchArr['EndAmount']))  );
        }

        if(!empty($searchArr['FromDate']) && !empty($searchArr['ToDate'])) {
            
            $fromDT = date('Y-m-d', strtotime($searchArr['FromDate']));
            $toDT = date('Y-m-d', strtotime($searchArr['ToDate']));
            $qSearch->andWhere('DATE_FORMAT(ca.CustomerPaidDate, "%Y-%m-%d") BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            //$qSearch->andWhere('ca.AgreementDate BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            //DATE_FORMAT(date,format)
        }


        // Code of Search query completes
        $defaultArr =  array(
        #'UserCaseNo'  =>  $searchArr['UserCaseNo'] ,
        'CaseNo'  =>  $searchArr['CaseNo'] ,
        'StartAmount' => ( ($searchArr['StartAmount'] != '' && $searchArr['EndAmount'] != '' ) ? $searchArr['StartAmount'] : '') ,
        'EndAmount'   => ( ($searchArr['StartAmount'] != '' && $searchArr['EndAmount'] != '' ) ? $searchArr['EndAmount'] : ''),
        'FromDate'    =>  $searchArr['FromDate'] ,
        'ToDate'      =>  $searchArr['ToDate'] ,

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

            $items = clsCommon::autoSuggestDashboardCaseNo($userId, array(sfConfig::get('app_CaseStage_Submitted')));

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
        $searchForm = new PaymentReportForm(array(),array('userId'=> $userId));
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
        $this->totalAcceptedCasesCount = CasesTable::GetCustomerAcceptedCaseCount($userId);
        #$this->totalPaidCasesCount = CasesTable::GetCustomerPaidCaseCount($userId);
        #$this->totalPendingCasesCount = CasesTable::GetCustomerPendingCaseCount($userId); 
        $this->totalCasesAmount = CasesTable::GetCustomerCaseAllAmount($userId);       


    } // End of Function


    /**
   * Customer Report, Customer Under Payment Report
   *
   * @param sfWebRequest $request
   */
    public function executeUnderPaymentReport(sfWebRequest $request)
    {
        
        $userId = $this->getUser()->getAttribute('admin_user_id');
        $qSearch = Doctrine_Query::create();
        $qSearch->from('Cases ca');
        $qSearch->where('ca.Stage = ? ', sfConfig::get('app_CaseStage_Close'));
        $qSearch->andWhere('ca.Status = ? ', sfConfig::get('app_CaseStatus_Active'));
        $qSearch->andWhere('ca.DifferenceAmount != ? ', "");
        $qSearch->andWhere('ca.UserId = ? ', $userId );
        $qSearch->orderBy('ca.CreateDateTime DESC' );
        
        #echo $qSearch;
        $pager = new sfDoctrinePager('Cases', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

    } // End of Function

}
