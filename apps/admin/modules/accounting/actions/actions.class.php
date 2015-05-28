<?php

/**
 * accounting actions.
 *
 * @package    counceledge
 * @subpackage accounting
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class accountingActions extends sfActions
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
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        $qSearch = Doctrine_Query::create();
        $qSearch->from('Cases ca');


        /*if($request->getParameter('search_text'))
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



        $pager = new sfDoctrinePager('Cases', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    }
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new CasesForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        #$this->form = new CasesForm();
        $this->form = new LogPaymentForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('logPayment');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), sprintf('Object cases does not exist (%s).', $request->getParameter('id')));
        $this->form = new CasesForm($cases);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), sprintf('Object cases does not exist (%s).', $request->getParameter('id')));
        $this->form = new CasesForm($cases);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();

        $this->forward404Unless($cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), sprintf('Object cases does not exist (%s).', $request->getParameter('id')));
        $cases->delete();

        $this->redirect('accounting/index');
    }

    // FUNCTION TO LOG PAYMENT TO CUSTOMER
    public function executeLogPayment(sfWebRequest $request){
        /*
        // GET CUSTOMER LIST
        $custList = UsersTable::getCustomers();
        $this->custList = $custList; */
        $this->form = new LogPaymentForm();
    } // End of Form

    /* On CUSTOMER change ajax call for display CASE INFO in dropdown*/
    public function executeGetUserCaseInfo(sfWebRequest $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $userId = $request->getParameter('userId');
            if($userId)
            {
                // GET CASES INFO BASED ON USERS
                $this->caseArr =  CasesTable::getUserCaseInfo($userId);

                //clsCommon::pr($info);exit;

                /*$output = '<option value="">Select</option>';
                foreach($caseArr as $c)                 {
                $output .= '<option value="'.$c['Id'].'">'.$c['Description'].'</option>';
                }*/
            }
            /*else
            {
            $output = '<option value="">Select</option>';
            }
            return $this->renderText($output);*/

        }
    } // End of Function


    // GET CASE PAYMENT RELATED DETAIL, CALLED THROUGH AJAX
    public function executeGetCasePaymentdetail(sfWebRequest $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $caseId = $request->getParameter('caseId');
            if($caseId)
            {
                // Calculate Customer Case Detail
                $output = clsCommon::calcCustomerPayment( $caseId ) ;
                #clsCommon::pr($output);
            }

            return $this->renderText(json_encode($output));
        }
    } // End of Function

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $logDetail = $request->getParameter($form->getName()) ;

            // Get Case Calulated Amount
            $caseAmtDetail  = clsCommon::calcCustomerPayment( $logDetail['CaseNo'] ) ;

            unset($form);
            # die;
            //$cases = $form->save();

            // Update Case table for Payment Information
            $date = date("Y-m-d H:i:s");
            $paidDate = $logDetail['CustomerPaidDate']['year'].'-'.$logDetail['CustomerPaidDate']['month'].'-'.$logDetail['CustomerPaidDate']['day'];
            $stage = sfConfig::get('app_CaseStage_Paid');
            $sql = Doctrine_Query::create()
            ->update('Cases c')
            ->set('c.CommisionPercentage', "'$caseAmtDetail[commision_percentage]'" )
            ->set('c.CommisionActual',"'$caseAmtDetail[commision_actual]'")
            ->set('c.ProcessingFees',"'$caseAmtDetail[processing_fees]'")
            ->set('c.UnderpayAdjustment',"'$caseAmtDetail[underpay_amount]'")
            ->set('c.PayableAmount',"'$caseAmtDetail[payable_amount]'")
            ->set('c.CustomerPaidDate',"'$paidDate'")
            ->set('c.Stage',"'$stage'")
            ->set('c.CheckNo',"'$logDetail[CheckNo]'")
            ->set('c.UpdateDateTime',"'$date'")
            ->where('c.Id = ?', $logDetail['CaseNo'] )
            ->execute();

            // Update Done

            // Add Entry for  Customer Payment Sent Table
            $custPaymentSent = new CustomerPaymentSent();
            $custPaymentSent->setUserId($logDetail['UserId']);
            $custPaymentSent->setCaseId($logDetail['CaseNo']);
            $custPaymentSent->setCaseNo($caseAmtDetail['case_no']);
            $custPaymentSent->setActualAmount($caseAmtDetail['actual_amount']);
            $custPaymentSent->setCommisionPercentage($caseAmtDetail['commision_percentage']);
            $custPaymentSent->setCommisionActual($caseAmtDetail['commision_actual']);
            $custPaymentSent->setProcessingFees($caseAmtDetail['processing_fees']);
            $custPaymentSent->setUnderpayAdjustment($caseAmtDetail['underpay_amount']);
            $custPaymentSent->setPayableAmount($caseAmtDetail['payable_amount']);
            $custPaymentSent->setPayableAmount($caseAmtDetail['payable_amount']);
            $custPaymentSent->setCustomerPaidDate($paidDate);
            $custPaymentSent->setCheckNo($logDetail['CheckNo']);
            $custPaymentSent->save();

            // Complete

            // Add To Case Activity - CheckSent
            $caseDetail = CasesTable::getCaseDetail($logDetail['CaseNo']);
            $thirdParties = ThirdPartiesTable::getThirdParties();
            $customerName = UsersTable::getUserDetailById($caseDetail['UserId']);
            $actDesc1 = '';
            $actDesc1 .= $caseDetail['CaseNo'].' - '.$caseDetail['FirstTitle'].' '.$caseDetail['LastTitle'].' case check has been sent to '.$customerName->getFirstName().' '.$customerName->getLastName().'.';
            $actDesc1 .= "\n";
            #$actDesc .= "<u>Case Detail:</u>";
            #$actDesc .= "\n";
            $actDesc1 .= "Case No.: ".$caseDetail['CaseNo'];
            $actDesc1 .= "\n";
            $actDesc1 .= "3rd Party: ".$thirdParties[$caseDetail['ThirdParty']];
            $actDesc1 .= "\n";
            $actDesc1 .= "Actual Amount: $".$caseDetail['ActualAmount'] ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Commission: $".$caseDetail['CommisionActual'] ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Processing Fee: $".$caseDetail['ProcessingFees'] ;
            $actDesc1 .= "\n";
            $actDesc1 .= "UnderPay Adjustment: $".((!empty($caseDetail['UnderpayAdjustment'])) ?  $caseDetail['UnderpayAdjustment'] : 0 )  ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Payable Amount: $".$caseDetail['PayableAmount'] ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Paid Date: ".date('Y-m-d',strtotime($caseDetail['CustomerPaidDate'])) ;
            // Activity Complete

            $activityArr1 = array();
            $activityArr1['CaseId'] = $caseDetail['Id'] ;
            $activityArr1['ActivityType'] = sfConfig::get('app_CaseActivityType_CheckSent') ;
            $activityArr1['Description'] = $actDesc1 ;
            $caseActivity1 = new CaseActivities();
            $caseActivity1->saveActivity($activityArr1);
            // Code complete

            $cases = Doctrine::getTable('Cases')->findOneBy('UserId',$logDetail['UserId']);
            #clsCommon::pr($cases,1);

            // Send Case Payment alert From Admin To Customer
            $arrParams = array();
            $arrParams['CustomerEmail']         = $cases->getCasesUsers()->getEmail();
            $arrParams['CustomerName']          = $cases->getCasesUsers()->getFirstName().' '.$cases->getCasesUsers()->getLastName();
            $arrParams['CaseNo']                = $cases->getCaseNo();
            $arrParams['CaseTitle']             = $cases->getFirstTitle().' '.$cases->getLastTitle();

            $arrParams['ActualAmount']          = $caseDetail['ActualAmount'];
            $arrParams['CommisionPercentage']   = $caseDetail['CommisionPercentage'];
            $arrParams['CommisionActual']       = $caseDetail['CommisionActual'];
            $arrParams['ProcessingFees']        = $caseDetail['ProcessingFees'];
            $arrParams['UnderpayAdjustment']    = $caseDetail['UnderpayAdjustment'];
            $arrParams['PayableAmount']         = $caseDetail['PayableAmount'];
            $arrParams['CustomerPaidDate']      = $caseDetail['CustomerPaidDate'];
            $arrParams['CheckNo']               = $caseDetail['CheckNo'];

            $objSiteMail = new siteMails();
            $objSiteMail->sendAdminPaymentCaseEmailToCustomer($arrParams);
            // Mail code Complete

            #clsCommon::pr($arrParams,1);

            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "Case successfully marked as Paid.");

            $this->redirect('accounting/customerPayReport');
            //$this->redirect('accounting/edit?id='.$cases->getId());
        }
    } // End of Function


    // FUNCTION TO SEE 3rd Party Payment received
    public function executeLogReceived(sfWebRequest $request){

        $this->form = new LogReceivedPaymentForm();
    } // End of Form


    public function executeCreateReceived(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        #$this->form = new CasesForm();
        $this->form = new LogReceivedPaymentForm();

        $this->processLogReceivedForm($request, $this->form);

        $this->setTemplate('logReceived');
    }


    /* FUNCTION TO GET 3rd PARTIES PAID CASES */
    public function executeGetThirdPartyPaidCases(sfWebRequest $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $partyId = $request->getParameter('partyId');
            if($partyId)  {
                // GET CASES INFO BASED ON USERS
                $this->caseArr =  CasesTable::GetThirdPartPaidCases($partyId);
                $this->setTemplate('getUserCaseInfo');
            }
        }
    } // End of Function


    protected function processLogReceivedForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $logDetail = $request->getParameter($form->getName()) ;


            // Get Case Calulated Amount
            $caseAmtDetail  = clsCommon::calcCustomerPayment( $logDetail['CaseNo'] ) ;
            //$caseDetail = CasesTable::getCaseDetail($logDetail['CaseNo']);
            /*clsCommon::pr($logDetail);
            clsCommon::pr($caseAmtDetail);
            die;    */
            unset($form);
            $differAmt = 0 ;
            if($logDetail['ReceivedAmount'] < $caseAmtDetail['actual_amount'] ) {
                $differAmt = ($caseAmtDetail['actual_amount'] - $logDetail['ReceivedAmount'] ) ;
            }

            // Update Case table for Payment Information
            $date = date("Y-m-d H:i:s")   ;
            $payRecdDate = $logDetail['PaymentReceivedDate']['year'].'-'.$logDetail['PaymentReceivedDate']['month'].'-'.$logDetail['PaymentReceivedDate']['day'];
            $stage = sfConfig::get('app_CaseStage_Close');
            $sql = Doctrine_Query::create()
            ->update('Cases c')
            ->set('c.ReceivedAmount', "'$logDetail[ReceivedAmount]'" )
            ->set('c.DifferenceAmount',"'$differAmt'")
            ->set('c.PaymentReceivedDate',"'$payRecdDate'")
            ->set('c.Stage',"'$stage'")
            ->set('c.UpdateDateTime',"'$date'")
            ->where('c.Id = ?', $logDetail['CaseNo'] )
            ->execute();

            // Update Done

            // Add Entry for Third Party Payment Received Customer Payment Sent Table
            $custPaymentSent = new ThirdPartyPaymentReceived();
            $custPaymentSent->setThirdParty($logDetail['ThirdParty']);
            $custPaymentSent->setCaseId($logDetail['CaseNo']);
            $custPaymentSent->setCaseNo($caseAmtDetail['case_no']);
            $custPaymentSent->setReceivedAmount($logDetail['ReceivedAmount']);
            $custPaymentSent->setDifferenceAmount($differAmt);
            $custPaymentSent->setPaymentReceivedDate($payRecdDate);
            $custPaymentSent->save();

            // Complete


            // Add To Case Activity - PaymentReceived
            $caseDetail = CasesTable::getCaseDetail($logDetail['CaseNo']);
            $thirdParties = ThirdPartiesTable::getThirdParties();
            $customerName = UsersTable::getUserDetailById($caseDetail['UserId']);
            $actDesc1 = '';
            $actDesc1 .= $caseDetail['CaseNo'].' - '.$caseDetail['FirstTitle'].' '.$caseDetail['LastTitle'].' case payment has been received from 3rd Party '.$thirdParties[$caseDetail['ThirdParty']].'.';
            $actDesc1 .= "\n";
            #$actDesc .= "<u>Case Detail:</u>";
            #$actDesc .= "\n";
            $actDesc1 .= "Case No.: ".$caseDetail['CaseNo'];
            $actDesc1 .= "\n";
            $actDesc1 .= "3rd Party: ".$thirdParties[$caseDetail['ThirdParty']];
            $actDesc1 .= "\n";
            $actDesc1 .= "Actual Amount: $".$caseDetail['ActualAmount'] ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Commission: $".$caseDetail['CommisionActual'] ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Processing Fee: $".$caseDetail['ProcessingFees'] ;
            $actDesc1 .= "\n";
            $actDesc1 .= "UnderPay Adjustment: $".((!empty($caseDetail['UnderpayAdjustment'])) ?  $caseDetail['UnderpayAdjustment'] : 0 )  ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Paid Amount: $".$caseDetail['PayableAmount'] ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Paid Date: ".date('Y-m-d',strtotime($caseDetail['CustomerPaidDate'])) ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Received Amount: $".$caseDetail['ReceivedAmount'] ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Difference Amount: $".$caseDetail['DifferenceAmount'] ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Received Date: ".date('Y-m-d',strtotime($caseDetail['PaymentReceivedDate'])) ;

            // Activity Complete

            $activityArr1 = array();
            $activityArr1['CaseId'] = $caseDetail['Id'] ;
            $activityArr1['ActivityType'] = sfConfig::get('app_CaseActivityType_PaymentReceived') ;
            $activityArr1['Description'] = $actDesc1 ;
            $caseActivity1 = new CaseActivities();
            $caseActivity1->saveActivity($activityArr1);
            // Code complete


            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "Case has been closed successfully");

            $this->redirect('accounting/thirdpartyPayReport');

        }
    } // End of Function

    // Function to Generate Customer Payment Report
    public function executeCustomerPayReport(sfWebRequest $request) {

        $qSearch = Doctrine_Query::create();
        $qSearch->from('CustomerPaymentSent cps');
        $qSearch->leftJoin('cps.CustomerPaymentSentCases cpsc');
        #$qSearch->whereIn('cpsc.Status', array(sfConfig::get('app_CaseStatus_Active'), sfConfig::get('app_CaseStatus_Inactive')));
        $qSearch->orderBy('cps.CustomerPaidDate DESC');
        

        // Default Search Array
        $searchArr = array(
        'UserId'     =>  '' ,
        #'UserCaseNo' =>  '' ,
        'CaseNo' =>  '' ,
        'FromDate'   =>  '' ,
        'ToDate'     =>  '' ,
        #'Amount'    =>  '' ,
        'StartAmount' =>  '' ,
        'EndAmount'   =>  '' ,

        );

        // Searching code if Selected from Search then comes here
        if($request->isMethod(sfRequest::POST )) {
            $searchForm = new SearchCustomerPayReportForm();
            $searchArr = $request->getParameter($searchForm->getName());
            #clsCommon::pr($searchArr);

        } else { // If done through pagination then comes here

            if($request->hasParameter('UserId')) {
                $searchArr['UserId'] = $request->getParameter('UserId');
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

            if($request->hasParameter('Amount')) {
                $searchArr['Amount'] = $request->getParameter('Amount');
            }

            if($request->hasParameter('StartAmount') && $request->hasParameter('EndAmount')) {
                $searchArr['StartAmount'] = $request->getParameter('StartAmount');
                $searchArr['EndAmount'] = $request->getParameter('EndAmount');
            }

        } // End of Else

        // Code for Searching Query
        if(!empty($searchArr['UserId']))
        $qSearch->andWhere('cps.UserId = ? ', $searchArr['UserId'] );

        /*if(!empty($searchArr['UserCaseNo'])) {
        $caseArr = CasesTable::getAllCaseNo();
        #echo $caseArr[$searchArr['UserCaseNo']];
        $qSearch->andWhere('cps.CaseNo = ? ', $caseArr[$searchArr['UserCaseNo']] );
        }*/

        if(!empty($searchArr['CaseNo'])) {
            $temp = explode(" ",$searchArr['CaseNo']);
            $qSearch->andWhere('cps.CaseNo LIKE ? ', '%'.$temp[0].'%' );
        }


        if(!empty($searchArr['FromDate']) && !empty($searchArr['ToDate'])) {
            $fromDT = date('Y-m-d',strtotime($searchArr['FromDate']));
            $toDT = date('Y-m-d',strtotime($searchArr['ToDate']));
            #$qSearch->andWhere('cps.CustomerPaidDate BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            $qSearch->andWhere('DATE_FORMAT(cps.CustomerPaidDate, "%Y-%m-%d") BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            
        }

        /*if(!empty($searchArr['Amount'])) {

        $splitAmt = explode('-', $searchArr['Amount']);
        #clsCommon::pr($splitAmt);
        if(count($splitAmt) == 2 ) {
        $qSearch->andWhere('cps.PayableAmount BETWEEN ? AND ? ', array(trim($splitAmt[0]) , trim($splitAmt[1]))  );
        } else {
        $qSearch->andWhere('cps.PayableAmount >=  ? ', trim($splitAmt[0])   );
        }

        }*/

        if($searchArr['StartAmount']  != '' && $searchArr['EndAmount'] != '' ) {
            $qSearch->andWhere('cps.PayableAmount BETWEEN ? AND ? ', array(trim($searchArr['StartAmount']) , trim($searchArr['EndAmount']))  );
        }


        // Code of Search query completes

        $defaultArr =  array(
        'UserId'     =>  $searchArr['UserId'] ,
        #'UserCaseNo'=>  $searchArr['UserCaseNo'] ,
        'CaseNo'     =>  $searchArr['CaseNo'] ,
        'FromDate'   =>  $searchArr['FromDate'] ,
        'ToDate'     =>  $searchArr['ToDate'] ,
        //'Amount'   =>  $searchArr['Amount'] ,
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
        $searchForm = new SearchCustomerPayReportForm(array(),array('UserId' => $defaultArr['UserId']));
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


    /**
     * Function to Get Selected Case
     *
     * @param sfWebRequest $request
     */
    public function executeGetSelectedCase(sfWebRequest $request) {
        $this->setLayout(false);

        $userId = NULL ;
        $stageArr = array();
        if($request->hasParameter('userid'))
        $userId = $request->getParameter('userid');

        if($request->hasParameter('stage')) {
            $stage = $request->getParameter('stage');
            if($stage == 'PC')
            $stageArr = array(sfConfig::get('app_CaseStage_Paid'), sfConfig::get('app_CaseStage_Close'));
        }


        $this->caseArr = CasesTable::getSelectedCases($userId, $stageArr);
        #clsCommon::pr($this->caseArr);

    } // End of Function


    // Function to Generate Customer Payment Report
    public function executeThirdpartyPayReport(sfWebRequest $request) {

        $qSearch = Doctrine_Query::create();
        $qSearch->from('ThirdPartyPaymentReceived tpr');
        $qSearch->leftJoin('tpr.ThirdPartyPaymentReceivedCases tprc');
        #$qSearch->whereIn('tprc.Status', array(sfConfig::get('app_CaseStatus_Active'), sfConfig::get('app_CaseStatus_Inactive')));
        $qSearch->orderBy('tpr.PaymentReceivedDate DESC');

        // Default Search Array
        $searchArr = array(
        'ThirdParty' =>  '' ,
        #'UserCaseNo' =>  '' ,
        'CaseNo' =>  '' ,
        'FromDate'   =>  '' ,
        'ToDate'     =>  '' ,
        'StartAmount'=>  '' ,
        'EndAmount'  =>  '' ,

        );

        // Searching code if Selected from Search then comes here
        if($request->isMethod(sfRequest::POST )) {
            $searchForm = new SearchThirdpartyPayReportForm();
            $searchArr = $request->getParameter($searchForm->getName());
            #clsCommon::pr($searchArr);

        } else { // If done through pagination then comes here

            if($request->hasParameter('ThirdParty')) {
                $searchArr['ThirdParty'] = $request->getParameter('ThirdParty');
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

            if($request->hasParameter('Amount')) {
                $searchArr['Amount'] = $request->getParameter('Amount');
            }

            if($request->hasParameter('StartAmount') && $request->hasParameter('EndAmount')) {
                $searchArr['StartAmount'] = $request->getParameter('StartAmount');
                $searchArr['EndAmount'] = $request->getParameter('EndAmount');
            }

        } // End of Else

        // Code for Searching Query
        if(!empty($searchArr['ThirdParty']))
        $qSearch->andWhere('tpr.ThirdParty = ? ', $searchArr['ThirdParty'] );

        /*if(!empty($searchArr['UserCaseNo'])) {
        $caseArr = CasesTable::getAllCaseNo();
        #echo $caseArr[$searchArr['UserCaseNo']];
        $qSearch->andWhere('tpr.CaseNo = ? ', $caseArr[$searchArr['UserCaseNo']] );
        }*/

        if(!empty($searchArr['CaseNo'])) {
            $temp = explode(" ",$searchArr['CaseNo']);
            $qSearch->andWhere('tpr.CaseNo LIKE ? ', '%'.$temp[0].'%' );
        }


        if(!empty($searchArr['FromDate']) && !empty($searchArr['ToDate'])) {
            $fromDT = date('Y-m-d',strtotime($searchArr['FromDate']));
            $toDT = date('Y-m-d',strtotime($searchArr['ToDate']));
            #$qSearch->andWhere('tpr.PaymentReceivedDate BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            $qSearch->andWhere('DATE_FORMAT(tpr.PaymentReceivedDate, "%Y-%m-%d") BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            //DATE_FORMAT(date,format)
        }

        if($searchArr['StartAmount'] != '' && $searchArr['EndAmount'] != '' ) {
            $qSearch->andWhere('tpr.ReceivedAmount BETWEEN ? AND ? ', array(trim($searchArr['StartAmount']) , trim($searchArr['EndAmount']))  );
        }


        // Code of Search query completes

        $defaultArr =  array(
        'ThirdParty' =>  $searchArr['ThirdParty'] ,
        #'UserCaseNo' =>  $searchArr['UserCaseNo'] ,
        'CaseNo' =>  $searchArr['CaseNo'] ,
        'FromDate'   =>  $searchArr['FromDate'] ,
        'ToDate'     =>  $searchArr['ToDate'] ,
        'StartAmount' => ( ($searchArr['StartAmount'] != '' && $searchArr['EndAmount'] != '' ) ? $searchArr['StartAmount'] : '') ,
        'EndAmount'   => ( ($searchArr['StartAmount'] != '' && $searchArr['EndAmount'] != '' ) ? $searchArr['EndAmount'] : '')

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
        $searchForm = new SearchThirdpartyPayReportForm();
        $this->searchForm = $searchForm ;

        $this->defaultArr = $defaultArr;
        $this->searchForm->setDefaults($defaultArr) ;

        #echo $qSearch;
        $pager = new sfDoctrinePager('ThirdPartyPaymentReceived', sfConfig::get('app_no_of_records_per_page'));
        #$pager = new sfDoctrinePager('ThirdPartyPaymentReceived', 2);
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

    } // End of Function


    /* FUNCTION TO GET 3rd PARTIES CLOSE CASES */
    public function executeGetThirdPartyCloseCases(sfWebRequest $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $partyId = $request->getParameter('partyId');
            if($partyId)  {
                // GET CASES INFO BASED ON USERS
                $this->caseArr =  CasesTable::GetThirdPartyCloseCases($partyId);
                $this->setTemplate('getUserCaseInfo');
            }
        }
    } // End of Function
} // End of class
