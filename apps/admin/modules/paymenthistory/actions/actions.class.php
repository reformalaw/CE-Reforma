<?php

/**
 * paymenthistory actions.
 *
 * @package    counceledge
 * @subpackage paymenthistory
 * @author     Chintan Fadia
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class paymenthistoryActions extends sfActions
{

    /**
	 * preExecutes index action
	 *
	 */
    public function preExecute()
    {
        /**
    * HERE IN THIS FUNCTION WE ARE CHECKING THAT USER IS NOT ADMIN AND PERMISSION CHECK IS FALSE
    * THE REDIRECT TO THE NOT AUTHENTICATED PAGE.
    */
        if (clsCommon::permissionCheck($this->getModuleName()."/".$this->getActionName()) == false){
            $this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
            $this->redirect('default/index');
        }

        $this->setLayout("dashboard");

        $request = $this->getRequest();
        $this->customerId =$request->getParameter('customerId');
        $this->caseId = $request->getParameter('caseId');

    }

    public function executeIndex(sfWebRequest $request)
    {
        $this->customerId = $request->getParameter('customerId');
        $this->caseId = $request->getParameter('caseId');
        $this->underPayAmt = CasesTable::getCustomerUnderPayAmt($this->customerId); // Get UnderPay Amount

        // Get Case Detail
        $this->caseObj = Doctrine::getTable('Cases')->find(array($this->caseId));

        // If Any Submited Case Comes From Direct URL Then Redirect to Summary Page
        if($this->caseObj->getStage() == sfConfig::get('app_CaseStage_Submitted')) {
            $this->getUser()->setFlash('errMsg', "Payment history will be available once case is accepted.");
            $this->redirect('dashboardcase/dashboardCaseDetails?customerId='.$this->customerId.'&caseId='.$this->caseId);
        }

        $qSearch = Doctrine_Query::create();
        $qSearch->from('CustomerPaymentSent cu');
        $qSearch->where('cu.CaseId = ? ', $this->caseId);
        $qSearch->orderBy('cu.CustomerPaidDate ASC');
        $pager = new sfDoctrinePager('CustomerPaymentSent', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

        $this->form = new CustomerPaymentSentForm(); // Log Payment Form
    }
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new CustomerPaymentSentForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->customerId = $request->getParameter('customerId');
        $this->caseId = $request->getParameter('caseId');
        $this->underPayAmt = CasesTable::getCustomerUnderPayAmt($this->customerId); // Get UnderPay Amount

        // Get Case Detail
        $this->caseObj = Doctrine::getTable('Cases')->find(array($this->caseId));

        // Check Payment can not be made for Cloase case
        if($this->caseObj->getStage() == sfConfig::get('app_CaseStage_Close')) {
            $this->getUser()->setFlash('errMsg', "Once case closed customer payments will not be updated.");
            $this->redirect('paymenthistory/index?customerId='.$this->customerId.'&caseId='.$this->caseId);
        }

        // Get Payment History
        $qSearch = Doctrine_Query::create();
        $qSearch->from('CustomerPaymentSent cu');
        $qSearch->where('cu.CaseId = ? ', $this->caseId);
        $qSearch->orderBy('cu.CreateDateTime DESC');
        $pager = new sfDoctrinePager('CustomerPaymentSent', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new CustomerPaymentSentForm();
        $this->processForm($request, $this->form);
        
        $this->setTemplate('index');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($customer_payment_sent = Doctrine::getTable('CustomerPaymentSent')->find(array($request->getParameter('id'))), sprintf('Object customer_payment_sent does not exist (%s).', $request->getParameter('id')));
        $this->form = new CustomerPaymentSentForm($customer_payment_sent);
        $this->form->setDefault('PayableAmount',$customer_payment_sent->getActualAmount() );
        $this->form->setDefault('CustomerPaidDate',date('m/d/Y', strtotime($customer_payment_sent->getCustomerPaidDate())) );

        $this->customerId = $request->getParameter('customerId');
        $this->caseId = $request->getParameter('caseId');
        $this->underPayAmt = CasesTable::getCustomerUnderPayAmt($this->customerId); // Get UnderPay Amount

        // Get Case Detail
        $this->caseObj = Doctrine::getTable('Cases')->find(array($this->caseId));

        // Check Payment can not be made for Close case
        if($this->caseObj->getStage() == sfConfig::get('app_CaseStage_Close')) {
            $this->getUser()->setFlash('errMsg', "Once case closed customer payments will not be updated.");
            $this->redirect('paymenthistory/index?customerId='.$this->customerId.'&caseId='.$this->caseId);
        }

        $qSearch = Doctrine_Query::create();
        $qSearch->from('CustomerPaymentSent cu');
        $qSearch->where('cu.CaseId = ? ', $this->caseId);
        $qSearch->orderBy('cu.CreateDateTime DESC');
        $pager = new sfDoctrinePager('CustomerPaymentSent', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
        $this->setTemplate('index');
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->customerId = $request->getParameter('customerId');
        $this->caseId = $request->getParameter('caseId');
        $this->underPayAmt = CasesTable::getCustomerUnderPayAmt($this->customerId); // Get UnderPay Amount

        // Get Case Detail
        $this->caseObj = Doctrine::getTable('Cases')->find(array($this->caseId));

        // Check Payment can not be made for Cloase case
        if($this->caseObj->getStage() == sfConfig::get('app_CaseStage_Close')) {
            $this->getUser()->setFlash('errMsg', "Once case closed customer payments will not be updated.");
            $this->redirect('paymenthistory/index?customerId='.$this->customerId.'&caseId='.$this->caseId);
        }

        $qSearch = Doctrine_Query::create();
        $qSearch->from('CustomerPaymentSent cu');
        $qSearch->where('cu.CaseId = ? ', $this->caseId);
        $qSearch->orderBy('cu.CreateDateTime DESC');
        $pager = new sfDoctrinePager('CustomerPaymentSent', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($customer_payment_sent = Doctrine::getTable('CustomerPaymentSent')->find(array($request->getParameter('id'))), sprintf('Object customer_payment_sent does not exist (%s).', $request->getParameter('id')));
        $this->form = new CustomerPaymentSentForm($customer_payment_sent);
        $this->form->setDefault('CustomerPaidDate',date('m/d/Y', strtotime($customer_payment_sent->getCustomerPaidDate())) );

        $this->processEditForm($request, $this->form, $customer_payment_sent);

        $this->setTemplate('index');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();
        $customerId = $request->getParameter('customerId');
        $caseId = $request->getParameter('caseId');

        $this->forward404Unless($customer_payment_sent = Doctrine::getTable('CustomerPaymentSent')->find(array($request->getParameter('id'))), sprintf('Object customer_payment_sent does not exist (%s).', $request->getParameter('id')));

        $cases = Doctrine::getTable('Cases')->find(array($caseId));
        // Check Payment can not be made for Close case
        if($cases->getStage() == sfConfig::get('app_CaseStage_Close')) {
            $this->getUser()->setFlash('errMsg', "Once case closed customer payments will not be updated.");
            $this->redirect('paymenthistory/index?customerId='.$customerId.'&caseId='.$caseId);
        }


        // Update Case Table for Deleted Payment
        $paiadAmt = $customer_payment_sent->getPayableAmount();
        $underAmt = $customer_payment_sent->getUnderpayAdjustment();


        $cases->setUnderpayAdjustment($cases->getUnderpayAdjustment() - $underAmt );
        $cases->setPaidAmount($cases->getPaidAmount() - $paiadAmt );
        $cases->setRemainToPay($cases->getRemainToPay() + $customer_payment_sent->getActualAmount() );
        $cases->save();

        // If
        #echo $cases->getPaidAmount(); die;
        if($cases->getPaidAmount() == '0' || $cases->getPaidAmount() == NULL) {
            $cases->setStage(sfConfig::get('app_CaseStage_Accepted'));
            $cases->save();
        }


        // Delete Payment
        $customer_payment_sent->delete();

        $this->getUser()->setFlash('errMsg', "Deletion successful.");
        $this->redirect('paymenthistory/index?customerId='.$customerId.'&caseId='.$caseId);
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $customerId = $request->getParameter('customerId');
        $caseId = $request->getParameter('caseId');

        // Check if Uderpay Adjustment should be greater than Underpay amount
        $errorExist = false;
        $underPayAmt = CasesTable::getCustomerUnderPayAmt($customerId); // Get UnderPay Amount
        $paymentArr = $request->getParameter($form->getName());
        
        //clsCommon::pr($paymentArr,1);
        //exit;
        if($underPayAmt < $paymentArr['UnderpayAdjustment']) {
            $errorExist = true;
            $this->getUser()->setFlash('errMsg', "Underpay adjustment should not be greater than underpay amount.");
            $paymentArr['UnderpayAdjustment'] = '';   
            $form->bind($paymentArr, $request->getFiles($form->getName()));
           
        }

        if ($form->isValid() && !$errorExist )
        {

            $caseDetail = Doctrine::getTable('Cases')->find(array($caseId));

            $customerPaidDate = date('Y-m-d', strtotime($paymentArr['CustomerPaidDate']));
            unset($form['CustomerPaidDate']);

            $paidAmt = $paymentArr['PayableAmount'];
            if(isset($paymentArr['UnderpayAdjustment']) && !empty($paymentArr['UnderpayAdjustment']) ) {
                unset($form['PayableAmount']);
                $paidAmt = $paymentArr['PayableAmount'] - $paymentArr['UnderpayAdjustment'];
                $form->getObject()->setPayableAmount($paidAmt);
            }

            $form->getObject()->setUserId($paymentArr['UserId']);
            $form->getObject()->setCaseId($paymentArr['CaseId']);
            $form->getObject()->setActualAmount($paymentArr['PayableAmount']);
            $form->getObject()->setCaseNo($caseDetail->getCaseNo());
            $form->getObject()->setCustomerPaidDate($customerPaidDate);
            $customer_payment_sent = $form->save();

            // Update Case Table
            if(isset($paymentArr['UnderpayAdjustment']) &&  !empty($paymentArr['UnderpayAdjustment'])  )
            $remainToPay  = $caseDetail->getPayableAmount() - ( ($caseDetail->getPaidAmount() + $paidAmt ) + ($caseDetail->getUnderpayAdjustment() + $paymentArr['UnderpayAdjustment'] ) );
            else{
                /*echo  $caseDetail->getPayableAmount() ;
                echo '<br>';
                echo $caseDetail->getPaidAmount() ;
                echo '+'. $paidAmt;
                echo '<br>';
                echo $caseDetail->getUnderpayAdjustment();
                echo '<br>';*/
                $remainToPay  = $caseDetail->getPayableAmount() - ( ($caseDetail->getPaidAmount() + $paidAmt) + $caseDetail->getUnderpayAdjustment() );
            }


            if(isset($paymentArr['UnderpayAdjustment'])  && !empty($paymentArr['UnderpayAdjustment']))
            $caseDetail->setUnderpayAdjustment($caseDetail->getUnderpayAdjustment() + $paymentArr['UnderpayAdjustment']);

            $caseDetail->setCustomerPaidDate($customer_payment_sent->getCustomerPaidDate());
            $caseDetail->setCheckNo($customer_payment_sent->getCheckNo());

            $caseDetail->setPaidAmount($caseDetail->getPaidAmount() + $paidAmt);
            $caseDetail->setstage(sfConfig::get('app_CaseStage_Paid'));
            $caseDetail->setRemainToPay(round($remainToPay,2));
            $caseDetail->save();
            // Complete


            // Add To Case Activity - CheckSent
            $actDesc1 = '';
            $actDesc1 .= $caseDetail->getCaseNo().' - '.$caseDetail->getFirstTitle().' '.$caseDetail->getLastTitle().' case check has been sent to '.$caseDetail->getCasesUsers()->getFirstName().' '.$caseDetail->getCasesUsers()->getLastName().'.';
            $actDesc1 .= "\n";
            $actDesc1 .= "Case No.: ".$caseDetail->getCaseNo();
            $actDesc1 .= "\n";
            $actDesc1 .= "3rd Party: ".$caseDetail->getCasesThirdParties()->getName();
            $actDesc1 .= "\n";
            $actDesc1 .= "Paid Amount: ".sfConfig::get('app_currency').$customer_payment_sent->getPayableAmount() ;
            $actDesc1 .= "\n";
            $actDesc1 .= "UnderPay Adjustment: ".sfConfig::get('app_currency').(($customer_payment_sent->getUnderpayAdjustment() !='') ?  $customer_payment_sent->getUnderpayAdjustment() : 0 )  ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Paid Date: ".date('Y-m-d',strtotime($customer_payment_sent->getCustomerPaidDate())) ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Check No.: ".$customer_payment_sent->getCheckNo() ;
            // Activity Complete

            $activityArr1 = array();
            $activityArr1['CaseId'] = $caseId ;
            $activityArr1['ActivityType'] = sfConfig::get('app_CaseActivityType_CheckSent') ;
            $activityArr1['Description'] = $actDesc1 ;
            $caseActivity1 = new CaseActivities();
            $caseActivity1->saveActivity($activityArr1);
            // Code complete

            $overPaidAmt = '';
            $remainToPaidAmt = $caseDetail->getRemainToPay();
            if($caseDetail->getPaidAmount() > $caseDetail->getPayableAmount()) {
                $remainToPaidAmt = 0;
                $overPaidAmt1 = $caseDetail->getPaidAmount() - $caseDetail->getPayableAmount();
                $overPaidAmt = "<tr><td>Overpaid Amount :</td><td>&#36;".$overPaidAmt1."</td></tr>";
            }


            // Send Case Payment alert From Admin To Customer
            $arrParams = array();
            $arrParams['CustomerEmail']         = $caseDetail->getCasesUsers()->getEmail();
            $arrParams['CustomerName']          = $caseDetail->getCasesUsers()->getFirstName().' '.$caseDetail->getCasesUsers()->getLastName();
            $arrParams['CaseNo']                = $caseDetail->getCaseNo();
            $arrParams['CaseTitle']             = $caseDetail->getFirstTitle().' '.$caseDetail->getLastTitle();

            $arrParams['ActualAmount']          = $caseDetail->getActualAmount();
            $arrParams['CommisionPercentage']   = $caseDetail->getCommisionPercentage();
            $arrParams['CommisionActual']       = $caseDetail->getCommisionActual();
            $arrParams['ProcessingFees']        = $caseDetail->getProcessingFees();
            $arrParams['UnderpayAdjustment']    = $caseDetail->getUnderpayAdjustment();
            $arrParams['PayableAmount']         = $caseDetail->getPayableAmount();
            $arrParams['TotalPaidAmount']       = $caseDetail->getPaidAmount();
            #$arrParams['RemainToPay']           = $caseDetail->getRemainToPay();
            $arrParams['RemainToPay']           = $remainToPaidAmt;
            $arrParams['OverpaidAmount']        = $overPaidAmt;


            $arrParams['NewPaidAmount']         = $customer_payment_sent->getPayableAmount();
            $arrParams['CheckNo']               = $customer_payment_sent->getCheckNo();
            $arrParams['CustomerPaidDate']      = $customer_payment_sent->getCustomerPaidDate();
            $arrParams['NewUnderpayAdjustment'] = $customer_payment_sent->getUnderpayAdjustment();

            #clsCommon::pr($arrParams,1);
            $objSiteMail = new siteMails();
            $objSiteMail->sendAdminPaymentCaseEmailToCustomer($arrParams);
            // Mail code Complete


            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "Payment done successfully.");

            $this->redirect('paymenthistory/index?customerId='.$customerId.'&caseId='.$caseId);
            //$this->redirect('paymenthistory/edit?id='.$customer_payment_sent->getId());
        }
    }

    protected function processEditForm(sfWebRequest $request, sfForm $form , $oldValObj )
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $customerId = $request->getParameter('customerId');
        $caseId = $request->getParameter('caseId');


        if ($form->isValid())
        {
            $paymentArr = $request->getParameter($form->getName());
            $oldValues = $oldValObj->toArray();
            $caseDetail = Doctrine::getTable('Cases')->find(array($caseId));
            #clsCommon::pr($paymentArr);
            #clsCommon::pr($oldValues);


            // Update Case Table
            /*$paiadAmt = $oldValues['PayableAmount'];
            $underAmt = $oldValues['UnderpayAdjustment'];
            $totAmt = $paiadAmt +  $underAmt ;*/
            $caseDetail->setUnderpayAdjustment($caseDetail->getUnderpayAdjustment() - $oldValues['UnderpayAdjustment'] );
            $caseDetail->setPaidAmount($caseDetail->getPaidAmount() - $oldValues['PayableAmount'] );
            $caseDetail->setRemainToPay($caseDetail->getRemainToPay() + $oldValues['PayableAmount'] + $oldValues['UnderpayAdjustment']);
            $caseDetail->save();
            $caseDetail->free();

            // Complete Case Update




            // Update Customer Payment sent Table
            $customerPaidDate = date('Y-m-d', strtotime($paymentArr['CustomerPaidDate']));
            unset($form['CustomerPaidDate']);

            $paidAmt = $paymentArr['PayableAmount'];
            if(isset($paymentArr['UnderpayAdjustment'])  ) {
                unset($form['PayableAmount']);
                $paidAmt = $paymentArr['PayableAmount'] - $paymentArr['UnderpayAdjustment'];
                $form->getObject()->setPayableAmount($paidAmt);
            }
            $form->getObject()->setActualAmount($paymentArr['PayableAmount']);
            $form->getObject()->setCustomerPaidDate($customerPaidDate);
            $customer_payment_sent = $form->save();
            // Update Complete


            // Update Case Table To reflect new entry in DB
            $caseObj = Doctrine::getTable('Cases')->find(array($caseId));
            #clsCommon::pr($caseObj->toArray());

            if(isset($paymentArr['UnderpayAdjustment'])  ) {
                $remainToPay  = $caseObj->getPayableAmount() - ( ($caseObj->getPaidAmount() + $paidAmt ) + ($caseObj->getUnderpayAdjustment() + $paymentArr['UnderpayAdjustment'] ) );
            } else {
                $remainToPay  = $caseObj->getPayableAmount() - ( ($caseObj->getPaidAmount() + $paidAmt) + $caseObj->getUnderpayAdjustment() );
            }

            if(isset($paymentArr['UnderpayAdjustment'])  )
            $caseObj->setUnderpayAdjustment($caseObj->getUnderpayAdjustment() + $paymentArr['UnderpayAdjustment']);


            $caseObj->setCustomerPaidDate($customer_payment_sent->getCustomerPaidDate());
            $caseObj->setCheckNo($customer_payment_sent->getCheckNo());
            $caseObj->setPaidAmount($caseObj->getPaidAmount() + $paidAmt);
            $caseObj->setRemainToPay(round($remainToPay,2));
            $caseObj->save();
            #$caseObj->free();
            // Code complete to Case

            // Add To Case Activity - CheckSent
            $actDesc1 = '';
            $actDesc1 .= $caseObj->getCaseNo().' - '.$caseObj->getFirstTitle().' '.$caseObj->getLastTitle().' case updated check has been sent to '.$caseObj->getCasesUsers()->getFirstName().' '.$caseObj->getCasesUsers()->getLastName().'.';
            $actDesc1 .= "\n";
            $actDesc1 .= "Case No.: ".$caseObj->getCaseNo();
            $actDesc1 .= "\n";
            $actDesc1 .= "3rd Party: ".$caseObj->getCasesThirdParties()->getName();
            $actDesc1 .= "\n";
            $actDesc1 .= "Edited Values:";
            $actDesc1 .= "\n";
            $actDesc1 .= "=================";
            $actDesc1 .= "\n";
            $actDesc1 .= "Paid Amount: ".sfConfig::get('app_currency').$customer_payment_sent->getPayableAmount() ;
            $actDesc1 .= "\n";
            $actDesc1 .= "UnderPay Adjustment: ".sfConfig::get('app_currency').(($customer_payment_sent->getUnderpayAdjustment() !='') ?  $customer_payment_sent->getUnderpayAdjustment() : 0 )  ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Paid Date: ".date('Y-m-d',strtotime($customer_payment_sent->getCustomerPaidDate())) ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Check No.: ".$customer_payment_sent->getCheckNo() ;
            // Activity Complete

            $activityArr1 = array();
            $activityArr1['CaseId'] = $caseId ;
            $activityArr1['ActivityType'] = sfConfig::get('app_CaseActivityType_CheckSent') ;
            $activityArr1['Description'] = $actDesc1 ;
            $caseActivity1 = new CaseActivities();
            $caseActivity1->saveActivity($activityArr1);
            // Code complete


            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "Payment done successfully.");

            $this->redirect('paymenthistory/index?customerId='.$customerId.'&caseId='.$caseId);
            //$this->redirect('paymenthistory/edit?id='.$customer_payment_sent->getId());
        }
    }

    public function executePrintinvoice(sfWebRequest $request) {

        $cases = Doctrine::getTable('Cases')->find(array($request->getParameter('caseId')));

        $case_payment_sent = Doctrine::getTable('CustomerPaymentSent')->find(array($request->getParameter('id')));

        $config = sfTCPDFPluginConfigHandler::loadConfig();

        // pdf object
        $pdf = new sfTCPDF();
        $wordCounseledge = clsCommon::getSystemConfigVars('SITE_NAME');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($wordCounseledge);
        $pdf->SetTitle($cases->getCaseNo());
        $pdf->SetSubject('Case Invoice');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        $pdf->SetFont('helvetica', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $pdf->Cell(175, 4,'CUSTOMER DETAILS','','','L');
        $pdf->Ln(6);
        $pdf->writeHTML('<hr>','','','','','C');
        $pdf->Ln(6);

        $pdf->Cell(75, 5,'Customer Name :','','','L');
        $pdf->Cell(100, 5,ucwords($cases->getCasesUsers()->getFirstName()." ".$cases->getCasesUsers()->getLastName()),'','','R');
        $pdf->Ln(6);

        $pdf->Cell(75, 5,'Address :','','','L');
        if ($cases->getCasesUsers()->getAddress1() != "") {
            $pdf->Cell(100, 5,ucwords($cases->getCasesUsers()->getAddress1().", ".$cases->getCasesUsers()->getAddress2()),'','','R');
            $pdf->Ln(6);
        }

        /*if ($cases->getCasesUsers()->getAddress2() != "") {
        $pdf->Cell(175, 5,$cases->getCasesUsers()->getAddress2(),'','','R');
        $pdf->Ln(6);
        }*/

        if ($cases->getCasesUsers()->getCity() != "") {
            $pdf->Cell(175, 5,ucwords($cases->getCasesUsers()->getCity().", ".$cases->getCasesUsers()->getUsersCounties()->getName()),'','','R');
            $pdf->Ln(6);
        }

        /*if ($cases->getCasesUsers()->getUsersCounties()->getName() != "") {
        $pdf->Cell(175, 5,$cases->getCasesUsers()->getUsersCounties()->getName(),'','','R');
        $pdf->Ln(6);
        }*/

        if ($cases->getCasesUsers()->getUsersStates()->getName() != "") {
            $pdf->Cell(175, 5,$cases->getCasesUsers()->getUsersStates()->getName()." - ".$cases->getCasesUsers()->getZip(),'','','R');
            $pdf->Ln(10);
        }

        /*if ($cases->getCasesUsers()->getZip() != "") {
        $pdf->Cell(175, 5,$cases->getCasesUsers()->getZip(),'','','R');
        $pdf->Ln(10);
        }*/

        $pdf->writeHTML('<hr>','','','','','C');
        $pdf->Ln(0);
        $pdf->Cell(175, 5,'3rd PARTY DETAILS','','','L');
        $pdf->Ln(6);
        $pdf->writeHTML('<hr>','','','','','C');
        $pdf->Ln(6);

        $pdf->Cell(75, 5,'Case No & Title :','','','L');
        $pdf->Cell(100, 5,$cases->getCaseNo()." - ".ucwords($cases->getFirstTitle()." ".$cases->getLastTitle()),'','','R');
        $pdf->Ln(6);

        /*$pdf->Cell(75, 5,'Title :','','','L');
        $pdf->Cell(100, 5,$cases->getFirstTitle()." ".$cases->getLastTitle(),'','','R');
        $pdf->Ln(6);*/

        $pdf->Cell(75, 5,'3rd Party Name :','','','L');
        $pdf->Cell(100, 5,ucwords($cases->getCasesThirdParties()->getName()),'','','R');
        $pdf->Ln(6);

        $pdf->Cell(75, 5,'Address :','','','L');
        if ($cases->getCasesThirdParties()->getAddress1() != "") {
            $pdf->Cell(100, 5,ucwords($cases->getCasesThirdParties()->getAddress1().', '.$cases->getCasesThirdParties()->getAddress2()),'','','R');
            $pdf->Ln(6);
        }

        /*if ($cases->getCasesThirdParties()->getAddress2() != "") {
        $pdf->Cell(175, 5,$cases->getCasesThirdParties()->getAddress2(),'','','R');
        $pdf->Ln(6);
        }*/

        if ($cases->getCasesThirdParties()->getCity() != "") {
            $pdf->Cell(175, 5,ucwords($cases->getCasesThirdParties()->getCity().', '.$cases->getCasesThirdParties()->getThirdPartiesCounties()->getName()),'','','R');
            $pdf->Ln(6);
        }

        /*if ($cases->getCasesThirdParties()->getThirdPartiesCounties()->getName() != "") {
        $pdf->Cell(175, 5,$cases->getCasesThirdParties()->getThirdPartiesCounties()->getName(),'','','R');
        $pdf->Ln(6);
        }*/

        if ($cases->getCasesThirdParties()->getThirdPartiesStates()->getName() != "") {
            $pdf->Cell(175, 5,ucwords($cases->getCasesThirdParties()->getThirdPartiesStates()->getName().'- '.$cases->getCasesThirdParties()->getZip()),'','','R');
            $pdf->Ln(10);
        }

        /*if ($cases->getCasesThirdParties()->getZip() != "") {
        $pdf->Cell(175, 5,$cases->getCasesThirdParties()->getZip(),'','','R');
        $pdf->Ln(10);
        }*/

        $pdf->writeHTML('<hr>','','','','','C');
        $pdf->Ln(0);
        $pdf->Cell(175, 5,'PAYMENT DETAILS','','','L');
        //$pdf->Cell(100, 5,'Paid Date : '.date('d/m/y',strtotime($case_payment_sent->getCustomerPaidDate())),'','','R');
        $pdf->Ln(6);
        $pdf->writeHTML('<hr>','','','','','C');
        $pdf->Ln(6);

        /*$pdf->Cell(75, 5,'','','','R');
        $pdf->Ln(6);*/

        if ($cases->getActualAmount() != "") {
            $actualAmt = '$'.$cases->getActualAmount();
        }else {
            $actualAmt = "---";
        }

        if ($case_payment_sent->getCheckNo() != "") {
            $pdf->Cell(75, 5,'Paid Date : ','','','L');
            $pdf->Cell(100, 5,date(sfConfig::get('app_dateformat'),strtotime($case_payment_sent->getCustomerPaidDate())),'','','R');
            $pdf->Ln(6);
        }
        if ($case_payment_sent->getCheckNo() != "") {
            $pdf->Cell(75, 5,'Check No. :','','','L');
            $pdf->Cell(100, 5,$case_payment_sent->getCheckNo(),'','','R');
            $pdf->Ln(6);
        }
        if ($case_payment_sent->getPayableAmount() != "") {
            $pdf->Cell(75, 5,'Paid Amount :','','','L');
            $pdf->Cell(100, 5,'$'.$case_payment_sent->getPayableAmount(),'','','R');
            $pdf->Ln(6);
        }
        if ($case_payment_sent->getUnderpayAdjustment() != "" && $case_payment_sent->getUnderpayAdjustment() != 0) {
            $pdf->Cell(75, 5,'Underpay Adjustment :','','','L');
            $pdf->Cell(100, 5,'$'.$case_payment_sent->getUnderpayAdjustment(),'','','R');
            $pdf->Ln(6);
        }

        /*$pdf->Cell(75, 5,'Actual Amount :','','','L');
        $pdf->Cell(100, 5,$actualAmt,'','','R');
        $pdf->Ln(6);

        if ($cases->getCommisionActual() != "") {
        $commisionAmt = '$'.$cases->getCommisionActual();
        }else {
        $commisionAmt = "---";
        }
        $pdf->Cell(75, 5,'Actual Commision :','','','L');
        $pdf->Cell(100, 5,$commisionAmt,'','','R');
        $pdf->Ln(6);

        if ($cases->getProcessingFees() != "") {
        $processinFee = '$'.$cases->getProcessingFees();
        }else {
        $processinFee = "---";
        }
        $pdf->Cell(75, 5,'Processing Fees :','','','L');
        $pdf->Cell(100, 5,$processinFee,'','','R');
        $pdf->Ln(6);

        if ($cases->getUnderpayAdjustment() != "") {
        $underPayAmt = '$'.$cases->getUnderpayAdjustment();
        }else {
        $underPayAmt = "---";
        }
        $pdf->Cell(75, 5,'Underpay Adjustment :','','','L');
        $pdf->Cell(100, 5,$underPayAmt,'','','R');
        $pdf->Ln(10);

        $pdf->writeHTML('<hr>','','','','','C');
        $pdf->Ln(0);
        $pdf->Cell(75, 5,'Payable Amount :','','','L');
        $pdf->Cell(100, 5,'$'.$cases->getPayableAmount(),'','','R');
        $pdf->Ln(6);
        $pdf->writeHTML('<hr>','','','','','C');
        $pdf->Ln(6);*/

        /*if ($cases->getStage() == sfConfig::get('app_CaseStage_Close')) {
        $pdf->writeHTML('<hr>','','','','','C');
        $pdf->Ln(0);
        $pdf->Cell(175, 5,'RECEIVED DETAILS','','','C');
        $pdf->Ln(6);
        $pdf->writeHTML('<hr>','','','','','C');
        $pdf->Ln(6);

        $pdf->Cell(75, 5,'Received Amount :','','','L');
        $pdf->Cell(100, 5,'$'.$cases->getReceivedAmount(),'','','R');
        $pdf->Ln(6);
        $pdf->Cell(75, 5,'Received Date :','','','L');
        $pdf->Cell(100, 5,date('d/m/y',strtotime($cases->getPaymentReceivedDate())),'','','R');
        $pdf->Ln(6);
        }*/

        ob_end_clean(); //Change To Avoid the PDF Error

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output($cases->getCaseNo().'-'.date('d/m/y').'.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }
}
