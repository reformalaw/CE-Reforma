<?php

/**
 * customercase actions.
 *
 * @package    counceledge
 * @subpackage customercase
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class customercaseActions extends sfActions
{
    /**
    * HERE IN THIS FUNCTION WE ARE CHECKING THAT USER IS NOT ADMIN AND PERMISSION CHECK IS FALSE
    * THE REDIRECT TO THE NOT AUTHENTICATED PAGE.
    */
    public function preExecute()
    {
        if (clsCommon::permissionCheck($this->getModuleName()."/".$this->getActionName()) == false){
            $this->redirect('default/NotAuthenticated');
        }

        $request = $this->getRequest();
        if($request->hasParameter('id'))
        {
            if($request->getParameter("id") != '')
            {
                $this->caseId = $request->getParameter("id");
                $caseData = Doctrine::getTable('Cases')->find(array($this->caseId));
                $customerId = $this->getUser()->getAttribute('admin_user_id');
                if($caseData->getUserId() != $customerId)
                {
                    $this->redirect("customercase/index");
                }
            }
            else
            $this->redirect("customercase/index");
        }
        // 		else
        // 			$this->redirect("customercase/index");
    }
    public function executeIndex(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        $customerId = $this->getUser()->getAttribute('admin_user_id');
        #$customerId = 4 ;

        $qSearch = Doctrine_Query::create();
        $qSearch->from('Cases ca');
        $qSearch->leftJoin('ca.CasesUsers cu');
        $qSearch->leftJoin('ca.CasesThirdParties ct');
        $qSearch->leftJoin('ca.CasesUsersCreatedBy U');                           // add relation in the to get user of creted by
        $qSearch->where('ca.Status = ? ', sfConfig::get('app_CaseStatus_Active'));
        $qSearch->andWhere('ca.UserId = ? ',  $customerId );

        // Default Search Array
        $searchArr = array(
        'CaseNo' =>  '' ,
        'FromDate'   =>  '' ,
        'ToDate'     =>  '' ,
        'Stage'      =>  '' ,
        );

        // Searching code if Selected from Search then comes here
        if($request->isMethod(sfRequest::POST )) {
            $searchForm = new SearchCustomersCaseForm();
            $searchArr = $request->getParameter($searchForm->getName());
            #clsCommon::pr($searchArr);

        } else { // If done through pagination then comes here

            if($request->hasParameter('CaseNo')) {
                $searchArr['CaseNo'] = $request->getParameter('CaseNo');
            }

            /*if($request->hasParameter('UserCaseNo')) {
            $searchArr['UserCaseNo'] = $request->getParameter('UserCaseNo');
            }*/

            if($request->hasParameter('FromDate')) {
                $searchArr['FromDate'] = base64_decode($request->getParameter('FromDate'));
            }
            if($request->hasParameter('ToDate')) {
                $searchArr['ToDate'] = base64_decode($request->getParameter('ToDate'));
            }

            if($request->hasParameter('Stage')) {
                $searchArr['Stage'] = $request->getParameter('Stage');
            }
        } // End of Else

        // Code for Searching Query
        /*if(!empty($searchArr['CaseNo'])) {
        $caseArr = CasesTable::getAllCaseNo();
        #echo $caseArr[$searchArr['UserCaseNo']];
        $qSearch->andWhere('ca.CaseNo LIKE ? ', '%'.$caseArr[$searchArr['CaseNo']]);
        }*/

        /*if(!empty($searchArr['CaseNo'])) {
        $qSearch->andWhere('ca.CaseNo LIKE ? ', '%'.$searchArr['CaseNo'].'%' );
        }*/

        if(!empty($searchArr['CaseNo'])) {
            $temp = explode(" ",$searchArr['CaseNo']);
            $qSearch->andWhere('ca.CaseNo LIKE ? ', '%'.$temp[0].'%' );
        }

        if(!empty($searchArr['FromDate']) && !empty($searchArr['ToDate'])) {
            $fromDT = date('Y-m-d',strtotime($searchArr['FromDate']));
            $toDT = date('Y-m-d',strtotime($searchArr['ToDate']));
            $qSearch->andWhere('ca.AgreementDate BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            #$qSearch->andWhere('DATE_FORMAT(ca.AgreementDate, "%m/%d/%Y") BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            //DATE_FORMAT(date,format)
        }

        if(!empty($searchArr['Stage'])) {
            $qSearch->andWhere('ca.Stage = ? ', $searchArr['Stage'] );
        }

        // Code of Search query completes

        $defaultArr =  array(
        'CaseNo' =>  $searchArr['CaseNo'] ,
        'FromDate'   =>  $searchArr['FromDate'] ,
        'ToDate'     =>  $searchArr['ToDate'] ,
        'Stage'      =>  $searchArr['Stage'] ,
        );

        // Search Form
        $searchForm = new SearchCustomersCaseForm();
        $this->searchForm = $searchForm ;

        $this->defaultArr = $defaultArr;
        $this->searchForm->setDefaults($defaultArr) ;

        switch($request->getParameter('orderBy'))
        {
            case "CaseNo":
                $orderBy = 'CaseNo';
                $this->orderBy = "CaseNo";
                break;
            case "FirstTitle":
                $orderBy = 'FirstTitle';
                $this->orderBy = "FirstTitle";
                break;
            case "ThirdParty":
                $orderBy = 'ct.Name';
                $this->orderBy = "ThirdParty";
                break;
            default:
                $orderBy = 'Id';
                $this->orderBy = "Id";
                break;
        }

        switch($request->getParameter('orderType'))
        {
            case "asc":
                $qSearch->orderBy("$orderBy ASC");
                $this->orderType = "asc";
                break;
            case "desc":
            default:
                $qSearch->orderBy("$orderBy DESC");
                $this->orderType = "desc";
                break;
        }

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

        #echo $qSearch;
        $pager = new sfDoctrinePager('Cases', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    }
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new CustomerCasesForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new CustomerCasesForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        if($request->hasParameter("bFlag"))
        $this->bFlag = $request->getParameter("bFlag");
        else
        $this->bFlag = 0;

        $this->forward404Unless($cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), sprintf('Object cases does not exist (%s).', $request->getParameter('id')));

        if($cases->getStatus() == sfConfig::get('app_CaseStatus_Deleted')) {
            $this->redirect('customercase/index');
        }

        if($cases->getStage() != sfConfig::get('app_CaseStage_Submitted')) {
            $this->redirect('customercase/view?id='.$cases->getId());
        }

        $this->caseDetail = $cases;
        $this->form = new CustomerCasesForm($cases);

    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), sprintf('Object cases does not exist (%s).', $request->getParameter('id')));

        $this->caseDetail = $cases;
        $this->form = new CustomerCasesForm($cases);

        $this->bFlag = $request->getPostParameter("bFlag");
        $this->processEditForm($request, $this->form,$this->bFlag, $cases);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();

        $this->forward404Unless($cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), sprintf('Object cases does not exist (%s).', $request->getParameter('id')));
        $cases->delete();

        $this->redirect('customercase/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $case = $request->getParameter($form->getName()) ;
        if ($form->isValid())
        {
            # here commission calcution function exist in clscommon
            $pay = clsCommon::commissionCalculation($case['ActualAmount']);

            $createdBy = $this->getUser()->getAttribute('admin_user_id');   // get logged user id from session
            $form->getObject()->setCreatedBy($createdBy);                   // set CreatedBy value
            $form->getObject()->setUserId($this->getUser()->getAttribute('admin_user_id'));
            $form->getObject()->setStage(sfConfig::get('app_CaseStage_Submitted'));
            $form->getObject()->setCommisionPercentage($pay['CommissionPer']);      # set commission in %
            $form->getObject()->setCommisionActual($pay['ActualCommission']);       # set Acutal commission
            $form->getObject()->setProcessingFees($pay['ProcessingFee']);           # set the processing fee
            $form->getObject()->setPayableAmount($pay['PayableAmt']);               # set the payable amt

            $cases = $form->save();

            $caseId = $cases->getId();

            #echo $caseNo = $date.$caseId;
            #echo $randomSquence = $date.'000000';

            $date = date('ym');
            $caseNo = ($date.'000000')+$caseId;
            $cases->setCaseNo($caseNo);
            $cases->save();

            // Add To Case Activity - CustomerBillsSubmitted
            $actDesc = '';
            $actDesc .= $cases->getCasesUsers()->getFirstName().' '.$cases->getCasesUsers()->getLastName().' has submitted case.';
            $actDesc .= "\n";
            #$actDesc .= "<u>Case Detail:</u>";
            #$actDesc .= "\n";
            $actDesc .= "Case No.: ".$caseNo;
            $actDesc .= "\n";
            $actDesc .= "3rd Party: ".$cases->getCasesThirdParties()->getName();
            $actDesc .= "\n";
            $actDesc .= "Case Actual Amount: ".sfConfig::get('app_currency').$cases->getActualAmount() ;
            $actDesc .= "\n";
            $actDesc .= "Commission Percentage :".$cases->getCommisionPercentage().'%' ;
            $actDesc .= "\n";
            $actDesc .= "Commission: ".sfConfig::get('app_currency').$cases->getCommisionActual() ;
            $actDesc .= "\n";
            $actDesc .= "Processing Fee: ".sfConfig::get('app_currency').$cases->getProcessingFees() ;
            $actDesc .= "\n";
            $actDesc .= "Payable Amount: ".sfConfig::get('app_currency').$cases->getPayableAmount() ;
            $actDesc .= "\n";

            $activityArr = array();
            $activityArr['CaseId'] = $caseId ;
            $activityArr['ActivityType'] = sfConfig::get('app_CaseActivityType_CustomerBillsSubmitted') ;
            $activityArr['Description'] = $actDesc ;
            $caseActivity = new CaseActivities();
            $caseActivity->saveActivity($activityArr);

            // Code Complete To Add Case to Activity Log

            // Send New Case Added Mail to Admin//
            $arrParams = array();
            $arrParams['CustomerName'] = $cases->getCasesUsers()->getFirstName().' '.$cases->getCasesUsers()->getLastName();
            $arrParams['CaseNo'] = $caseNo;
            $arrParams['CaseTitle'] = $cases->getFirstTitle().' '.$cases->getLastTitle();
            #clsCommon::pr($arrParams);
            $objSiteMail = new siteMails();
            $objSiteMail->sendNewCaseRegEmailToAdmin($arrParams);
            // Mail code Complete

            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "New case added successfully.");

            $this->redirect('customercase/index');
            //} // End of If Has Error

        } // End of if Valid



    } // End of Function

    protected function processEditForm(sfWebRequest $request, sfForm $form, $bFlag , $oldCaseDetail)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $case = $request->getParameter($form->getName()) ;
        $oldCaseInfo = $oldCaseDetail->toArray();

        if ($form->isValid())
        {
            # here commission calcution function exist in clscommon
            #$pay = clsCommon::commissionCalculation($case['ActualAmount']);
            $pay = clsCommon::editCaseCommissionCalculation($case['ActualAmount'] , $oldCaseInfo['CommisionPercentage'] , $oldCaseInfo['ProcessingFees']  );
            $form->getObject()->setCommisionPercentage($pay['CommissionPer']);      # set commission in %
            $form->getObject()->setCommisionActual($pay['ActualCommission']);       # set Acutal commission
            $form->getObject()->setProcessingFees($pay['ProcessingFee']);           # set the processing fee
            $form->getObject()->setPayableAmount($pay['PayableAmt']);               # set the payable amt
            $cases = $form->save();


            // Add To Case Activity - CustomerBillsSubmitted
            $actDesc = '';
            $actDesc .= $cases->getCasesUsers()->getFirstName().' '.$cases->getCasesUsers()->getLastName().' has updated case.';
            $actDesc .= "\n";
            #$actDesc .= "<u>Case Detail:</u>";
            #$actDesc .= "\n";
            $actDesc .= "Case No.: ".$cases->getCaseNo();
            $actDesc .= "\n";
            $actDesc .= "Edited Values:";
            $actDesc .= "\n";
            $actDesc .= "=================";
            $actDesc .= "\n";
            $actDesc .= "3rd Party: ".$cases->getCasesThirdParties()->getName();
            $actDesc .= "\n";
            $actDesc .= "Case Actual Amount: ".sfConfig::get('app_currency').$cases->getActualAmount() ;
            $actDesc .= "\n";
            $actDesc .= "Commission Percentage :".$cases->getCommisionPercentage().'%' ;
            $actDesc .= "\n";
            $actDesc .= "Commission: ".sfConfig::get('app_currency').$cases->getCommisionActual() ;
            $actDesc .= "\n";
            $actDesc .= "Processing Fee: ".sfConfig::get('app_currency').$cases->getProcessingFees() ;
            $actDesc .= "\n";
            $actDesc .= "Payable Amount: ".sfConfig::get('app_currency').$cases->getPayableAmount() ;
            $actDesc .= "\n";

            $activityArr = array();
            $activityArr['CaseId'] = $cases->getId() ;
            $activityArr['ActivityType'] = sfConfig::get('app_CaseActivityType_CustomerBillsSubmitted') ;
            $activityArr['Description'] = $actDesc ;
            $caseActivity = new CaseActivities();
            $caseActivity->saveActivity($activityArr);

            // Code Complete To Add Case to Activity Log

            $this->getUser()->setFlash('succMsg', "Case updated successfully");
            if($bFlag == 1)
            $this->redirect("customercase/view?id=".$cases->getId());
            else
            $this->redirect('customercase/index');
            //} // End of If Has Error

        } // End of if Valid

    } // End of Function


    /**
     * Function To Change Case Status to Active / Inactive / Deleted
     */    
    public function executeChangeStatus(sfWebRequest $request)
    {
        $this->forward404Unless($cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), sprintf('Case not found!'));
        $status = $request->getParameter('status');

        if($cases->getStage() == sfConfig::get('app_CaseStage_Submitted')) { // Customer can delete only Submitted Case not Accepted, Paid and Closed

            // Do not allow to change status of current user
            if (in_array($status,array(sfConfig::get('app_CaseStatus_Active'),sfConfig::get('app_CaseStatus_Inactive'), sfConfig::get('app_CaseStatus_Deleted')))){
                $cases->setStatus($status);
                $cases->setUpdateDateTime(date("Y-m-d H:i:s"));
                $cases->save();
                #$arrParams = array();

                if($status == sfConfig::get('app_CaseStatus_Active') ){
                    $this->getUser()->setFlash("succMsg",'Status successfully changed to Active.');
                    #$arrParams['Status'] = sfConfig::get('app_CaseStatus_Active');

                } else if($status == sfConfig::get('app_CaseStatus_Inactive')) {
                    $this->getUser()->setFlash("errMsg",'Status successfully changed to inactive.');
                    #$arrParams['Status'] = sfConfig::get('app_CaseStatus_Inactive');

                } else if ($status == sfConfig::get('app_CaseStatus_Deleted')){
                    if($request->hasParameter("bFlag"))
                    $this->bFlag = $request->getParameter("bFlag");

                    $this->getUser()->setFlash("errMsg",'Deletion successful.');
                    #$arrParams['Status'] = sfConfig::get('app_CaseStatus_Deleted');

                    // Send Case Delete Alert to Admin
                    $arrParams = array();
                    $arrParams['CustomerName'] = $cases->getCasesUsers()->getFirstName().' '.$cases->getCasesUsers()->getLastName();
                    $arrParams['CaseNo'] = $cases->getCaseNo();
                    $arrParams['CaseTitle'] = $cases->getFirstTitle().' '.$cases->getLastTitle();
                    #clsCommon::pr($arrParams);
                    $objSiteMail = new siteMails();
                    $objSiteMail->sendDeleteCaseEmailToAdmin($arrParams);
                    // Mail code Complete


                }

            }
        } else {
            $this->getUser()->setFlash("errMsg",'You can not delete the case once its accepted.');
        }

        $this->redirect('customercase/index');

    } // End of Function

    public function executeView(sfWebRequest $request)
    {
        // DISPLAY 404 PAGE IF FAQ NOT EXIST.
        $this->forward404Unless($this->case = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), 'Cases does not exist.');

        if($this->case->getStatus() == sfConfig::get('app_CaseStatus_Deleted')) {
            $this->redirect('customercase/index');
        }

        $this->case_payment = Doctrine_Core::getTable('CustomerPaymentSent')->findBy('CaseId',$request->getParameter('id'));
    }

    public function executePrintinvoice(sfWebRequest $request) {

        $cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id')));
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        // pdf object
        $pdf = new sfTCPDF();

        $wordCounseledge = clsCommon::getSystemConfigVars('SITE_NAME');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($wordCounseledge);
        $pdf->SetTitle('Example 001');
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
        $pdf->Cell(100, 5,$cases->getCasesUsers()->getFirstName()." ".$cases->getCasesUsers()->getLastName(),'','','R');
        $pdf->Ln(6);

        $pdf->Cell(75, 5,'Address :','','','L');
        if ($cases->getCasesUsers()->getAddress1() != "")
        {
            $pdf->Cell(100, 5,$cases->getCasesUsers()->getAddress1(),'','','R');
            $pdf->Ln(6);
        }

        if ($cases->getCasesUsers()->getAddress2() != "")
        {
            $pdf->Cell(175, 5,$cases->getCasesUsers()->getAddress2(),'','','R');
            $pdf->Ln(6);
        }

        if ($cases->getCasesUsers()->getCity() != "") {
            $pdf->Cell(175, 5,$cases->getCasesUsers()->getCity(),'','','R');
            $pdf->Ln(6);
        }

        if ($cases->getCasesUsers()->getUsersCounties()->getName() != "") {
            $pdf->Cell(175, 5,$cases->getCasesUsers()->getUsersCounties()->getName(),'','','R');
            $pdf->Ln(6);
        }

        if ($cases->getCasesUsers()->getUsersStates()->getName() != "") {
            $pdf->Cell(175, 5,$cases->getCasesUsers()->getUsersStates()->getName(),'','','R');
            $pdf->Ln(6);
        }

        if ($cases->getCasesUsers()->getZip() != "") {
            $pdf->Cell(175, 5,$cases->getCasesUsers()->getZip(),'','','R');
            $pdf->Ln(10);
        }

        $pdf->writeHTML('<hr>','','','','','C');
        $pdf->Ln(0);
        $pdf->Cell(175, 5,'3rd PARTY DETAILS','','','L');
        $pdf->Ln(6);
        $pdf->writeHTML('<hr>','','','','','C');
        $pdf->Ln(6);

        $pdf->Cell(75, 5,'Case No :','','','L');
        $pdf->Cell(100, 5,$cases->getCaseNo(),'','','R');
        $pdf->Ln(6);

        $pdf->Cell(75, 5,'Title :','','','L');
        $pdf->Cell(100, 5,$cases->getFirstTitle()." ".$cases->getLastTitle(),'','','R');
        $pdf->Ln(6);

        $pdf->Cell(75, 5,'3rd Party Name :','','','L');

        if ($cases->getCasesThirdParties()->getName() != "") {
            $pdf->Cell(100, 5,$cases->getCasesThirdParties()->getName(),'','','R');
            $pdf->Ln(6);
        }

        $pdf->Cell(75, 5,'Address :','','','L');
        if ($cases->getCasesThirdParties()->getAddress1() != "") {
            $pdf->Cell(100, 5,$cases->getCasesThirdParties()->getAddress1(),'','','R');
            $pdf->Ln(6);
        }

        if ($cases->getCasesThirdParties()->getAddress2() != "") {
            $pdf->Cell(175, 5,$cases->getCasesThirdParties()->getAddress2(),'','','R');
            $pdf->Ln(6);
        }

        if ($cases->getCasesThirdParties()->getCity() != "") {
            $pdf->Cell(175, 5,$cases->getCasesThirdParties()->getCity(),'','','R');
            $pdf->Ln(6);
        }

        if ($cases->getCasesThirdParties()->getThirdPartiesCounties()->getName() != "") {
            $pdf->Cell(175, 5,$cases->getCasesThirdParties()->getThirdPartiesCounties()->getName(),'','','R');
            $pdf->Ln(6);
        }

        if ($cases->getCasesThirdParties()->getThirdPartiesStates()->getName() != "") {
            $pdf->Cell(175, 5,$cases->getCasesThirdParties()->getThirdPartiesStates()->getName(),'','','R');
            $pdf->Ln(6);
        }

        if ($cases->getCasesThirdParties()->getZip() != "") {
            $pdf->Cell(175, 5,$cases->getCasesThirdParties()->getZip(),'','','R');
            $pdf->Ln(10);
        }

        $pdf->writeHTML('<hr>','','','','','C');
        $pdf->Ln(0);
        $pdf->Cell(75, 5,'PAYMENT DETAILS','','','L');
        $pdf->Cell(100, 5,'Paid Date : '.date('d/m/y',strtotime($cases->getCustomerPaidDate())),'','','R');
        $pdf->Ln(6);
        $pdf->writeHTML('<hr>','','','','','C');
        $pdf->Ln(6);

        $pdf->Cell(75, 5,'','','','R');
        $pdf->Ln(6);

        if ($cases->getActualAmount() != "") {
            $actualAmt = '$'.$cases->getActualAmount();
        }else {
            $actualAmt = "---";
        }
        $pdf->Cell(75, 5,'Actual Amount :','','','L');
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
        $pdf->Ln(6);

        ob_end_clean(); //Change To Avoid the PDF Error
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('example_001.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function executePaymentPrintinvoice(sfWebRequest $request) {

        $cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id')));
        $case_payment_sent = Doctrine::getTable('CustomerPaymentSent')->find(array($request->getParameter('pId')));
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
            $pdf->Cell(100, 5,ucwords($cases->getCasesUsers()->getAddress1()." , ".$cases->getCasesUsers()->getAddress2()),'','','R');
            $pdf->Ln(6);
        }

        /*if ($cases->getCasesUsers()->getAddress2() != "") {
        $pdf->Cell(175, 5,$cases->getCasesUsers()->getAddress2(),'','','R');
        $pdf->Ln(6);
        }*/

        if ($cases->getCasesUsers()->getCity() != "") {
            $pdf->Cell(175, 5,ucwords($cases->getCasesUsers()->getCity()." , ".$cases->getCasesUsers()->getUsersCounties()->getName()),'','','R');
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
            $pdf->Cell(100, 5,ucwords($cases->getCasesThirdParties()->getAddress1().' , '.$cases->getCasesThirdParties()->getAddress2()),'','','R');
            $pdf->Ln(6);
        }

        /*if ($cases->getCasesThirdParties()->getAddress2() != "") {
        $pdf->Cell(175, 5,$cases->getCasesThirdParties()->getAddress2(),'','','R');
        $pdf->Ln(6);
        }*/

        if ($cases->getCasesThirdParties()->getCity() != "") {
            $pdf->Cell(175, 5,ucwords($cases->getCasesThirdParties()->getCity().' , '.$cases->getCasesThirdParties()->getThirdPartiesCounties()->getName()),'','','R');
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
            $pdf->Cell(75, 5,'Received Date : ','','','L');
            $pdf->Cell(100, 5,date('d/m/y',strtotime($case_payment_sent->getCustomerPaidDate())),'','','R');
            $pdf->Ln(6);
        }
        if ($case_payment_sent->getCheckNo() != "") {
            $pdf->Cell(75, 5,'Check No. :','','','L');
            $pdf->Cell(100, 5,$case_payment_sent->getCheckNo(),'','','R');
            $pdf->Ln(6);
        }
        if ($case_payment_sent->getPayableAmount() != "") {
            $pdf->Cell(75, 5,'Payments Disbursed :','','','L');
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

    // This Function will show Received Payment history for case
    public function executePaymentreceived(sfWebRequest $request){

        // DISPLAY 404 PAGE IF FAQ NOT EXIST.
        $this->forward404Unless($this->case = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), 'Cases does not exist.');
        $this->case_payment = Doctrine_Core::getTable('CustomerPaymentSent')->findBy('CaseId',$request->getParameter('id'));



    } // End of Fuction
}
