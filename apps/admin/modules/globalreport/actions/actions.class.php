<?php

/**
 * globalreport actions.
 *
 * @package    counceledge
 * @subpackage globalreport
 * @author     Chintan Fadia
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class globalreportActions extends sfActions
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
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {
        //$this->forward('default', 'module');
    }


    // FUNCTION FOR UNAPAID BILLS FOR CUSTOMER REPORT
    public function executeUnpaidCustomer(sfWebRequest $request)
    {
        $qSearch = Doctrine_Query::create();
        $qSearch->from('Cases ca');
        $qSearch->leftJoin('ca.CasesUsers cu');
        #$qSearch->where('ca.Stage = ? ', sfConfig::get('app_CaseStage_Accepted')); // Old Criteria

        /* New criteria */
        $qSearch->whereIN('ca.Stage', array(sfConfig::get('app_CaseStage_Accepted'), sfConfig::get('app_CaseStage_Paid')));
        $qSearch->andWhere('( IFNULL(ca.PaidAmount,0) + IFNULL(ca.UnderpayAdjustment,0) )< ca.PayableAmount');
        #$qSearch->andWhere(' IFNULL(ca.PaidAmount,0) < ca.PayableAmount');
        /* complete new */

        $qSearch->andWhere('ca.Status = ? ', sfConfig::get('app_CaseStatus_Active'));
        $qSearch->andWhere('ca.CaseNo != ? ', '' );
        $qSearch->orderBy('ca.CreateDateTime DESC' );

        // Default Search Array
        $searchArr = array(
        'UserId'     =>  '' ,
        'StartAmount' =>  '' ,
        'EndAmount'   =>  '' ,
        );

        // Searching code if Selected from Search then comes here
        if($request->isMethod(sfRequest::POST )) {
            $searchForm = new UnpaidCustomerBillReportForm();
            $searchArr = $request->getParameter($searchForm->getName());
        } else { // If done through pagination then comes here

            if($request->hasParameter('UserId')) {
                $searchArr['UserId'] = $request->getParameter('UserId');
            }

            if($request->hasParameter('StartAmount') && $request->hasParameter('EndAmount')) {
                $searchArr['StartAmount'] = $request->getParameter('StartAmount');
                $searchArr['EndAmount'] = $request->getParameter('EndAmount');
            }

        } // End of Else

        // Code for Searching Query
        if(!empty($searchArr['UserId']))
        $qSearch->andWhere('ca.UserId = ? ', $searchArr['UserId'] );

        if($searchArr['StartAmount'] != '' && $searchArr['EndAmount'] != '') {
            $qSearch->andWhere('ca.ActualAmount BETWEEN ? AND ? ', array(trim($searchArr['StartAmount']) , trim($searchArr['EndAmount']))  );
        }



        // Code of Search query completes
        $defaultArr =  array(
        'UserId'     =>  $searchArr['UserId'] ,
        'StartAmount' => ( ($searchArr['StartAmount'] != '' && $searchArr['EndAmount'] != '' ) ? $searchArr['StartAmount'] : '') ,
        'EndAmount'   => ( ($searchArr['StartAmount'] != '' && $searchArr['EndAmount'] != '' ) ? $searchArr['EndAmount'] : '')
        );
        #clsCommon::pr($defaultArr);



        // Search Form for customer Payment Report Form
        $searchForm = new UnpaidCustomerBillReportForm();
        $this->searchForm = $searchForm ;

        $this->defaultArr = $defaultArr;
        $this->searchForm->setDefaults($defaultArr) ;

        #echo $qSearch;
        $pager = new sfDoctrinePager('Cases', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    } // End of Function

    // FUNCTION FOR UNAPAID CASES FROM 3RD PARTY REPORT
    public function executeUnpaidThirdparty(sfWebRequest $request)
    {
        $qSearch = Doctrine_Query::create();
        $qSearch->from('Cases ca');
        $qSearch->leftJoin('ca.CasesUsers cu');
        $qSearch->leftJoin('ca.CasesThirdParties ct');
        #$qSearch->where('ca.Stage = ? ', sfConfig::get('app_CaseStage_Paid')); #Old Criteria

        /* New criteria */
        $qSearch->whereIN('ca.Stage', array(sfConfig::get('app_CaseStage_Accepted'), sfConfig::get('app_CaseStage_Paid')));
        $qSearch->andWhere('IFNULL(ca.ReceivedAmount,0) < ca.ActualAmount');
        /* complete new */

        $qSearch->andWhere('ca.Status = ? ', sfConfig::get('app_CaseStatus_Active'));
        $qSearch->andWhere('ca.CaseNo != ? ', '' );
        $qSearch->orderBy('ca.CreateDateTime DESC' );


        // Default Search Array
        $searchArr = array(
        'UserId'     => '' ,
        'ThirdParty' => '',
        #'UserCaseNo' => '',
        'CaseNo' => '',
        'StartAmount'=> '' ,
        'EndAmount'  => '' ,
        );

        // Searching code if Selected from Search then comes here
        if($request->isMethod(sfRequest::POST )) {
            $searchForm = new UnpaidThirdPartyBillReportForm();
            $searchArr = $request->getParameter($searchForm->getName());
        } else { // If done through pagination then comes here

            if($request->hasParameter('UserId')) {
                $searchArr['UserId'] = $request->getParameter('UserId');
            }

            if($request->hasParameter('ThirdParty')) {
                $searchArr['ThirdParty'] = $request->getParameter('ThirdParty');
            }

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

        } // End of Else

        // Code for Searching Query
        if(!empty($searchArr['UserId']))
        $qSearch->andWhere('ca.UserId = ? ', $searchArr['UserId'] );

        if(!empty($searchArr['ThirdParty']))
        $qSearch->andWhere('ca.ThirdParty = ? ', $searchArr['ThirdParty'] );

        /*if(!empty($searchArr['UserCaseNo'])) {
        $caseArr = CasesTable::getAllCaseNo();
        $qSearch->andWhere('ca.CaseNo = ? ', $caseArr[$searchArr['UserCaseNo']] );
        }*/

        if(!empty($searchArr['CaseNo'])) {
            $temp = explode(" ",$searchArr['CaseNo']);
            $qSearch->andWhere('ca.CaseNo LIKE ? ', '%'.$temp[0].'%' );
        }

        /*if(!empty($searchArr['CaseNo'])) {
        $caseArr = CasesTable::getAllCaseNo();
        $qSearch->andWhere('ca.CaseNo LIKE ? ', '%'.$searchArr['CaseNo'].'%');
        }*/

        if($searchArr['StartAmount'] != ''  && $searchArr['EndAmount'] != '' ) {
            $qSearch->andWhere('ca.ActualAmount BETWEEN ? AND ? ', array(trim($searchArr['StartAmount']) , trim($searchArr['EndAmount']))  );
        }

        // Code of Search query completes

        $defaultArr =  array(
        'UserId'     =>  $searchArr['UserId'] ,
        'ThirdParty' =>  $searchArr['ThirdParty'] ,
        #'UserCaseNo' =>  $searchArr['UserCaseNo'] ,
        'CaseNo'    =>  $searchArr['CaseNo'] ,
        'StartAmount'=> ( ($searchArr['StartAmount'] != '' && $searchArr['EndAmount'] != '' ) ? $searchArr['StartAmount'] : '') ,
        'EndAmount'  => ( ($searchArr['StartAmount'] != '' && $searchArr['EndAmount'] != '' ) ? $searchArr['EndAmount'] : '')
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

            $items = clsCommon::autoSuggestCaseNo();

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
        $searchForm = new UnpaidThirdPartyBillReportForm();
        $this->searchForm = $searchForm ;

        $this->defaultArr = $defaultArr;
        $this->searchForm->setDefaults($defaultArr) ;

        #echo $qSearch;
        $pager = new sfDoctrinePager('Cases', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    } // End of Function

    // FUNCTION FOR FINANCE REPORT (Cumulative for all customers)
    public function executeFinance(sfWebRequest $request)
    {

        // Summary Query
        $qsumary = Doctrine_Query::create();
        #$qsumary->select('COUNT(Id) as totalcases,   IFNULL(SUM(ca.PayableAmount),0) as totalamountpaid, IFNULL(SUM(ca.ReceivedAmount),0) as totalamountreceived, IFNULL(SUM(ca.UnderpayAdjustment),0) as totalunderpayamount, (SELECT COUNT(subcase.Id) FROM Cases subcase WHERE subcase.Stage IN ("'.sfConfig::get("app_CaseStage_Paid").'", "'.sfConfig::get("app_CaseStage_Close").'") AND subcase.Status = "'.sfConfig::get("app_CaseStatus_Active").'" ) AS paidcases, (SELECT COUNT(subcase2.Id) FROM Cases subcase2 WHERE subcase2.Stage IN ("'.sfConfig::get("app_CaseStage_Accepted").'") AND subcase2.Status = "'.sfConfig::get("app_CaseStatus_Active").'") as unpaidcases, (SELECT COUNT(subcase3.Id) FROM Cases subcase3 WHERE subcase3.Stage IN ("'.sfConfig::get("app_CaseStage_Paid").'") AND subcase3.Status = "'.sfConfig::get("app_CaseStatus_Active").'") as totalpendingcases '   );

        $qsumary->select('COUNT(Id) as totalcases,   IFNULL(SUM(ca.PaidAmount),0) as totalamountpaid, IFNULL(SUM(ca.ReceivedAmount),0) as totalamountreceived, IFNULL(SUM(ca.UnderpayAdjustment),0) as totalunderpayamount '   );
        $qsumary->from('cases ca');
        $qsumary->leftJoin('ca.CasesUsers u');
        $qsumary->whereIN('ca.Status', array(sfConfig::get('app_CaseStatus_Active'), sfConfig::get('app_CaseStatus_Inactive')) );
        $qsumary->andWhere('ca.Stage !=  ? ', sfConfig::get('app_CaseStage_Submitted'));
        $qsumary->andWhere('u.BillingSubscription =  ? ', 'Yes');
        $qsumary->andWhere('u.UserType =  ? ', sfConfig::get('app_UserType_Customer'));
        $qsumary->andWhere('u.Status !=  ? ', sfConfig::get('app_UserStatus_Pending'));
        $summary = $qsumary->fetchArray();
        #clsCommon::pr($summary);
        $this->summary = $summary[0] ;
        // Completed


        /**
         * Only For 
            *  Active Status Users
            * Billing subscription = Yes
            * Usertype = Customer
         * 
         * UserWise below
            * Total Amount Paid = Sum of Payable Amount 
            * Recived Amount = Sum of Received Amount
            * Underpay Amount = Sum of Underpay Amount
            * Total Cases = Count of All Cases
            * Total Paid Cases = Count of Paid or Close Cases
            * Total Unpaid Cases = Count of Submitted or Accepted Cases
            * Total Pensing Payment Cases from 3rd Party = Count of Paid Cases only
         */

        $qSearch = Doctrine_Query::create();
        /*$qSearch->select('ca.UserId,  cu.FirstName as firstname, cu.LastName as lastname, IFNULL(SUM(ca.PayableAmount),0) as paidamount, IFNULL(SUM(ca.ReceivedAmount),0) as receivedamount, IFNULL(SUM(ca.UnderpayAdjustment),0) as underpayadjustment,
        count(ca.Id) as totalcases,
        (SELECT COUNT(subcase.Id) FROM Cases subcase WHERE subcase.Stage IN ("'.sfConfig::get("app_CaseStage_Paid").'", "'.sfConfig::get("app_CaseStage_Close").'") AND subcase.UserId=cu.Id  AND subcase.Status = "'.sfConfig::get("app_CaseStatus_Active").'") AS totalpaidcases,
        (SELECT COUNT(subcase2.Id) FROM Cases subcase2 WHERE subcase2.Stage IN ("'.sfConfig::get("app_CaseStage_Accepted").'") AND subcase2.UserId = cu.Id AND subcase2.Status = "'.sfConfig::get("app_CaseStatus_Active").'") as totalunpaidcases,
        (SELECT COUNT(subcase3.Id) FROM Cases subcase3 WHERE subcase3.Stage IN ("'.sfConfig::get("app_CaseStage_Paid").'") AND subcase3.UserId = cu.Id  AND subcase3.Status = "'.sfConfig::get("app_CaseStatus_Active").'") as totalpendingcases'
        );*/

        $qSearch->select('ca.UserId as userid,  cu.FirstName as firstname, cu.LastName as lastname, IFNULL(SUM(ca.PaidAmount),0) as padamount, IFNULL(SUM(ca.ReceivedAmount),0) as recdamount, IFNULL(SUM(ca.UnderpayAdjustment),0) as underpayadjustment,
                        
                        
                         (SELECT COUNT(subcase4.Id) FROM Cases subcase4 WHERE subcase4.Stage  IN ("'.sfConfig::get("app_CaseStage_Accepted").'","'.sfConfig::get("app_CaseStage_Paid").'", "'.sfConfig::get("app_CaseStage_Close").'") AND subcase4.UserId=cu.Id  AND subcase4.Status IN ( "'.sfConfig::get("app_CaseStatus_Active").'" , "'.sfConfig::get("app_CaseStatus_Inactive").'") ) AS totalcases '        
                         ); 
                         
                         $qSearch->from('Users cu');
                         $qSearch->leftJoin('cu.UsersCases ca');
                         $qSearch->WhereIN('cu.Status', array(sfConfig::get('app_UserStatus_Active'), sfConfig::get('app_UserStatus_Inactive'), sfConfig::get('app_UserStatus_Deleted')));
                         $qSearch->andWhere('cu.BillingSubscription = ? ', 'Yes');
                         $qSearch->andWhere('cu.UserType = ? ', sfConfig::get('app_UserType_Customer'));
                         $qSearch->andWhereIn('ca.Status', array(sfConfig::get('app_CaseStatus_Active'), sfConfig::get('app_CaseStatus_Inactive')));
                         $qSearch->andWhereIn('ca.Stage', array(sfConfig::get('app_CaseStage_Accepted'), sfConfig::get('app_CaseStage_Paid'), sfConfig::get('app_CaseStage_Close')));
                         $qSearch->groupBy('cu.Id' );
                         $qSearch->orderBy('cu.FirstName ASC' );


                         #echo $qSearch->getSqlQuery();
                         #$res = $qSearch->fetchArray();*/


                         // Default Search Array
                         $searchArr = array(
                         'UserId'   =>  '' ,
                         'FromDate' =>  '' ,
                         'ToDate'   =>  ''
                         );

                         // Searching code if Selected from Search then comes here
                         if($request->isMethod(sfRequest::POST )) {
                             $searchForm = new FinanceForm();
                             $searchArr = $request->getParameter($searchForm->getName());
                         } else { // If done through pagination then comes here

                             if($request->hasParameter('UserId')) {
                                 $searchArr['UserId'] = $request->getParameter('UserId');
                             }

                             if($request->hasParameter('FromDate')) {
                                 $searchArr['FromDate'] = base64_decode($request->getParameter('FromDate'));
                             }
                             if($request->hasParameter('ToDate')) {
                                 $searchArr['ToDate'] = base64_decode($request->getParameter('ToDate'));
                             }


                         } // End of Else

                         // Code for Searching Query
                         if(!empty($searchArr['UserId']) ) {
                             $qSearch->andWhere('cu.Id = ?  ', $searchArr['UserId'] );
                         }


                         if(!empty($searchArr['FromDate']) && !empty($searchArr['ToDate'])) {
                             $fromDT = date('Y-m-d', strtotime($searchArr['FromDate']));
                             $toDT = date('Y-m-d', strtotime($searchArr['ToDate']));
                             
                             #$qSearch->andWhere('DATE_FORMAT(ca.CreateDateTime, "%Y-%m-%d") BETWEEN ? AND ? ', array($fromDT , $toDT)  );
                             $qSearch->andWhere('(DATE_FORMAT(ca.CreateDateTime, "%Y-%m-%d") >=  "'.$fromDT.'"  AND DATE_FORMAT(ca.CreateDateTime, "%Y-%m-%d") <=  "'.$toDT.'") ' );


                             /*$qSearch->select('ca.UserId,  cu.FirstName as firstname, cu.LastName as lastname, IFNULL(SUM(ca.PaidAmount),0) as padamount, IFNULL(SUM(ca.ReceivedAmount),0) as recdamount, IFNULL(SUM(ca.UnderpayAdjustment),0) as underpayadjustment,
                               (SELECT COUNT(subcase4.Id) FROM Cases subcase4 WHERE subcase4.Stage  IN ("'.sfConfig::get("app_CaseStage_Accepted").'","'.sfConfig::get("app_CaseStage_Paid").'", "'.sfConfig::get("app_CaseStage_Close").'") AND subcase4.UserId=cu.Id  AND subcase4.Status = "'.sfConfig::get("app_CaseStatus_Active").'" AND DATE_FORMAT(subcase4.CreateDateTime, "%m/%d/%Y") BETWEEN "'.$fromDT.'" AND "'.$toDT.'") AS totalcases ' ); */
                             
                             $qSearch->select('ca.UserId,  cu.FirstName as firstname, cu.LastName as lastname, IFNULL(SUM(ca.PaidAmount),0) as padamount, IFNULL(SUM(ca.ReceivedAmount),0) as recdamount, IFNULL(SUM(ca.UnderpayAdjustment),0) as underpayadjustment,
                               (SELECT COUNT(subcase4.Id) FROM Cases subcase4 WHERE subcase4.Stage  IN ("'.sfConfig::get("app_CaseStage_Accepted").'","'.sfConfig::get("app_CaseStage_Paid").'", "'.sfConfig::get("app_CaseStage_Close").'") AND subcase4.UserId=cu.Id  AND subcase4.Status IN ( "'.sfConfig::get("app_CaseStatus_Active").'" , "'.sfConfig::get("app_CaseStatus_Inactive").'") AND 
                               ( DATE_FORMAT(subcase4.CreateDateTime, "%Y-%m-%d")  >= "'.$fromDT.'" AND DATE_FORMAT(subcase4.CreateDateTime, "%Y-%m-%d") <= "'.$toDT.'") ) AS totalcases ' ); 

                         }

                         // Code of Search query completes
                         $defaultArr =  array(
                         'UserId'     =>  $searchArr['UserId'] ,
                         'FromDate'   =>  $searchArr['FromDate'] ,
                         'ToDate'     =>  $searchArr['ToDate'] ,
                         );
                         #clsCommon::pr($defaultArr);

                         // Search Form for customer Payment Report Form
                         $searchForm = new FinanceForm();
                         $this->searchForm = $searchForm ;

                         $this->defaultArr = $defaultArr;
                         $this->searchForm->setDefaults($defaultArr) ;

                         #echo $qSearch;

                         $pager = new sfDoctrinePager('Users', sfConfig::get('app_no_of_records_per_page'));
                         $pager->setQuery($qSearch);
                         $pager->setPage($request->getParameter('page', 1));
                         $pager->init();
                         $this->pager = $pager;

    } // End of Function


    // FUNCTION FOR FINANCE REPORT FOR Total Amount Paid (Cumulative for all customers)
    public function executeFinance1(sfWebRequest $request)
    {
        // Total Amount Paid

        /* $qSearch = Doctrine_Query::create();
        $qSearch->select('ca.UserId, SUM(ca.PayableAmount) as paidamount, cu.FirstName as firstname, cu.LastName as lastname' );
        $qSearch->from('Cases ca');
        $qSearch->leftJoin('ca.CasesUsers cu');
        $qSearch->Where('ca.Status = ? ', sfConfig::get('app_CaseStatus_Active'));
        $qSearch->andWhereIn('ca.Stage', array (sfConfig::get('app_CaseStage_Paid'),sfConfig::get('app_CaseStage_Close')) );
        $qSearch->andWhere('ca.CaseNo != ? ', '' );
        $qSearch->orderBy('cu.FirstName ASC' );
        $qSearch->groupBy('ca.UserId' );*/


        $qSearch = Doctrine_Query::create();
        $qSearch->select('ca.UserId, SUM(ca.PayableAmount) as paidamount, cu.FirstName as firstname, cu.LastName as lastname' );
        $qSearch->from('CustomerPaymentSent ca');
        $qSearch->leftJoin('ca.CustomerPaymentSentUsers cu');
        # $qSearch->leftJoin('ca.CustomerPaymentSentCases c');
        $qSearch->orderBy('cu.FirstName ASC' );
        $qSearch->groupBy('ca.UserId' );

        // Default Search Array
        $searchArr = array(
        'FromDate' =>  '' ,
        'ToDate'   =>  '' ,
        );

        // Searching code if Selected from Search then comes here
        if($request->isMethod(sfRequest::POST )) {
            $searchForm = new FinanceForm();
            $searchArr = $request->getParameter($searchForm->getName());
        } else { // If done through pagination then comes here

            if($request->hasParameter('FromDate')) {
                $searchArr['FromDate'] = base64_decode($request->getParameter('FromDate'));
            }
            if($request->hasParameter('ToDate')) {
                $searchArr['ToDate'] = base64_decode($request->getParameter('ToDate'));
            }

            /*if($request->hasParameter('StartAmount') && $request->hasParameter('EndAmount')) {
            $searchArr['StartAmount'] = $request->getParameter('StartAmount');
            $searchArr['EndAmount'] = $request->getParameter('EndAmount');
            }*/

        } // End of Else

        // Code for Searching Query
        /*if(!empty($searchArr['StartAmount'] ) && !empty($searchArr['EndAmount'] )) {
        $qSearch->andWhere('ca.ActualAmount BETWEEN ? AND ? ', array(trim($searchArr['StartAmount']) , trim($searchArr['EndAmount']))  );
        }*/

        if(!empty($searchArr['FromDate']) && !empty($searchArr['ToDate'])) {
            $fromDT = $searchArr['FromDate'];
            $toDT = $searchArr['ToDate'];
            //$qSearch->andWhere('ca.AgreementDate BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            $qSearch->andWhere('DATE_FORMAT(ca.CustomerPaidDate, "%m/%d/%Y") BETWEEN ? AND ? ', array($fromDT , $toDT)  );
        }


        // Code of Search query completes
        $defaultArr =  array(
        'FromDate'   =>  $searchArr['FromDate'] ,
        'ToDate'     =>  $searchArr['ToDate'] ,
        );
        #clsCommon::pr($defaultArr);

        // Search Form for customer Payment Report Form
        $searchForm = new FinanceForm();
        $this->searchForm = $searchForm ;

        $this->defaultArr = $defaultArr;
        $this->searchForm->setDefaults($defaultArr) ;

        #echo $qSearch;
        $pager = new sfDoctrinePager('CustomerPaymentSent', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

    } // End of Function


    // FUNCTION FOR FINANCE REPORT FOR Total amount received (Cumulative for 3rd parties)
    public function executeFinanceReceived(sfWebRequest $request)
    {
        // Total Amount Paid

        /*$qSearch = Doctrine_Query::create();
        $qSearch->select('ca.ThirdParty, SUM(ca.ReceivedAmount) as receivedamount, ct.Name as tpname' ); //, ct.Name as tpname
        $qSearch->from('Cases ca');
        $qSearch->leftJoin('ca.CasesThirdParties ct');
        $qSearch->where('ca.Stage = ? ', sfConfig::get('app_CaseStage_Close'));
        $qSearch->andWhere('ca.Status = ? ', sfConfig::get('app_CaseStatus_Active'));
        $qSearch->andWhere('ca.CaseNo != ? ', '' );
        $qSearch->orderBy('ct.Name ASC' );
        $qSearch->groupBy('ca.ThirdParty' );*/


        $qSearch = Doctrine_Query::create();
        $qSearch->select('ca.ThirdParty, SUM(ca.ReceivedAmount) as receivedamount, ct.Name as tpname' ); //, ct.Name as tpname
        $qSearch->from('ThirdPartyPaymentReceived ca');
        $qSearch->leftJoin('ca.ThirdPartyPaymentReceivedThirdParties ct');
        $qSearch->orderBy('ct.Name ASC' );
        $qSearch->groupBy('ca.ThirdParty');

        // Default Search Array
        $searchArr = array(
        'FromDate' =>  '' ,
        'ToDate'   =>  '' ,
        );

        // Searching code if Selected from Search then comes here
        if($request->isMethod(sfRequest::POST )) {
            $searchForm = new FinanceForm();
            $searchArr = $request->getParameter($searchForm->getName());
        } else { // If done through pagination then comes here

            if($request->hasParameter('FromDate')) {
                $searchArr['FromDate'] = base64_decode($request->getParameter('FromDate'));
            }
            if($request->hasParameter('ToDate')) {
                $searchArr['ToDate'] = base64_decode($request->getParameter('ToDate'));
            }

            /*if($request->hasParameter('StartAmount') && $request->hasParameter('EndAmount')) {
            $searchArr['StartAmount'] = $request->getParameter('StartAmount');
            $searchArr['EndAmount'] = $request->getParameter('EndAmount');
            }*/

        } // End of Else

        // Code for Searching Query
        /*if(!empty($searchArr['StartAmount'] ) && !empty($searchArr['EndAmount'] )) {
        $qSearch->andWhere('ca.ActualAmount BETWEEN ? AND ? ', array(trim($searchArr['StartAmount']) , trim($searchArr['EndAmount']))  );
        }*/

        if(!empty($searchArr['FromDate']) && !empty($searchArr['ToDate'])) {
            $fromDT = $searchArr['FromDate'];
            $toDT = $searchArr['ToDate'];
            //$qSearch->andWhere('ca.AgreementDate BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            $qSearch->andWhere('DATE_FORMAT(ca.PaymentReceivedDate, "%m/%d/%Y") BETWEEN ? AND ? ', array($fromDT , $toDT)  );
        }


        // Code of Search query completes
        $defaultArr =  array(
        'FromDate'   =>  $searchArr['FromDate'] ,
        'ToDate'     =>  $searchArr['ToDate'] ,
        );
        #clsCommon::pr($defaultArr);

        // Search Form for customer Payment Report Form
        $searchForm = new FinanceForm();
        $this->searchForm = $searchForm ;

        $this->defaultArr = $defaultArr;
        $this->searchForm->setDefaults($defaultArr) ;


        #echo $qSearch;
        #die;
        $pager = new sfDoctrinePager('ThirdPartyPaymentReceived', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    } // End of Function


    // FUNCTION FOR FINANCE REPORT FOR Total Under Payment amount  (Cumulative for all customers)
    public function executeFinanceUnderpay(sfWebRequest $request)
    {
        $qSearch = Doctrine_Query::create();
        $qSearch->select('ca.UserId, SUM(ca.UnderpayAdjustment) as underpayamt, cu.FirstName as firstname, cu.LastName as lastname' );
        $qSearch->from('Cases ca');
        $qSearch->leftJoin('ca.CasesUsers cu');
        $qSearch->Where('ca.Status = ? ', sfConfig::get('app_CaseStatus_Active'));
        //$qSearch->andWhereIn('ca.Stage', array (sfConfig::get('app_CaseStage_Paid'),sfConfig::get('app_CaseStage_Close')) );
        $qSearch->andWhere('ca.CaseNo != ? ', '' );
        $qSearch->andWhere('ca.UnderpayAdjustment != ? ', '' );
        $qSearch->orderBy('cu.FirstName ASC' );
        $qSearch->groupBy('ca.UserId' );

        #echo $qSearch;

        $pager = new sfDoctrinePager('Cases', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    } // End of Function

}
