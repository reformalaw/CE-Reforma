<?php

/**
 * case actions.
 *
 * @package    counceledge
 * @subpackage case
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $ this is very old
 */
class caseActions extends sfActions
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
        $qSearch->leftJoin('ca.CasesUsers cu');
        $qSearch->leftJoin('ca.CasesThirdParties ct');
        $qSearch->leftJoin('ca.CasesUsersCreatedBy U');                           // add relation in the to get user of creted by
        $qSearch->where('ca.Status != ? ', sfConfig::get('app_CaseStatus_Deleted'));
        #$qSearch->andWhereIn('cu.Status', array(sfConfig::get('app_UserStatus_Active'),sfConfig::get('app_UserStatus_Inactive')) );
        $qSearch->andWhere('ca.CaseNo != ? ', '' );

        // Default Search Array
        $searchArr = array(
        'UserId'     =>  '' ,
        #'UserCaseNo' =>  '' ,
        'CaseNo'     =>  '' ,
        'FromDate'   =>  '' ,
        'ToDate'     =>  '' ,
        'Stage'      =>  '' ,
        'Status'     =>  ''
        );

        // Searching code if Selected from Search then comes here
        if($request->isMethod(sfRequest::POST )) {
            $searchForm = new SearchAdminCaseForm();
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

            if($request->hasParameter('Stage')) {
                $searchArr['Stage'] = $request->getParameter('Stage');
            }
            if($request->hasParameter('Status')) {
                $searchArr['Status'] = $request->getParameter('Status');
            }

        } // End of Else

        // Code for Searching Query
        if(!empty($searchArr['UserId']))
        $qSearch->andWhere('ca.UserId = ? ', $searchArr['UserId'] );

        /*if(!empty($searchArr['UserCaseNo'])) {
        $caseArr = CasesTable::getAllCaseNo();
        #echo $caseArr[$searchArr['UserCaseNo']];
        $qSearch->andWhere('ca.CaseNo = ? ', $caseArr[$searchArr['UserCaseNo']] );
        }*/

        if(!empty($searchArr['CaseNo'])) {
            $temp = explode(" ",$searchArr['CaseNo']);
            $qSearch->andWhere('ca.CaseNo LIKE ? ', '%'.$temp[0].'%' );
        }

        if(!empty($searchArr['FromDate']) && !empty($searchArr['ToDate'])) {
            $fromDT = date('Y-m-d',strtotime($searchArr['FromDate']));
            $toDT = date('Y-m-d',strtotime($searchArr['ToDate']));
            $qSearch->andWhere('DATE_FORMAT(ca.AgreementDate, "%Y-%m-%d") BETWEEN ? AND ? ', array($fromDT , $toDT ));
            #$qSearch->andWhere('DATE_FORMAT(ca.AgreementDate, "%m/%d/%Y") BETWEEN ? AND ? ', array($fromDT , $toDT)  );
            //DATE_FORMAT(date,format)
        }

        if(!empty($searchArr['Stage'])) {
            $qSearch->andWhere('ca.Stage = ? ', $searchArr['Stage'] );
        }

        if(!empty($searchArr['Status'])) {
            $qSearch->andWhere('ca.Status = ? ', $searchArr['Status'] );
        }
        // Code of Search query completes

        $defaultArr =  array(
        'UserId'     =>  $searchArr['UserId'] ,
        #'UserCaseNo' =>  $searchArr['UserCaseNo'] ,
        'CaseNo'     =>  $searchArr['CaseNo'] ,
        'FromDate'   =>  $searchArr['FromDate'] ,
        'ToDate'     =>  $searchArr['ToDate'] ,
        'Stage'      =>  $searchArr['Stage'] ,
        'Status'     =>  $searchArr['Status']
        );

        // Search Form
        $searchForm = new SearchAdminCaseForm(array(),array('UserId' => $defaultArr['UserId']));
        $this->searchForm = $searchForm ;

        $this->defaultArr = $defaultArr;
        $this->searchForm->setDefaults($defaultArr) ;

        #clsCommon::pr($searchArr);
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
            case "User":
                $orderBy = 'cu.FirstName';
                $this->orderBy = "User";
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

        #echo $qSearch;
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

        $this->form = new CasesForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), sprintf('Object cases does not exist (%s).', $request->getParameter('id')));
        $this->caseDetail = $cases;
        $this->form = new CasesForm($cases);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), sprintf('Object cases does not exist (%s).', $request->getParameter('id')));

        $this->caseDetail = $cases;
        $this->form = new CasesForm($cases);

        $this->processEditForm($request, $this->form , $cases);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();

        $this->forward404Unless($cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), sprintf('Object cases does not exist (%s).', $request->getParameter('id')));
        $cases->delete();

        $this->redirect('case/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $case = $request->getParameter($form->getName()) ;
        if ($form->isValid())
        {

            # here commission calcution function exist in clscommon
            $pay = clsCommon::commissionCalculation($case['ActualAmount']);

            $agreementDate = date('Y-m-d', strtotime($case['AgreementDate']));
            unset($form['AgreementDate']);


            $createdBy = $this->getUser()->getAttribute('admin_user_id');           # get logged user id from session
            $form->getObject()->setCreatedBy($createdBy);                           # set CreatedBy value
            #$form->getObject()->setUserId($request->getParameter('customerId'));    # set case the userId
            $form->getObject()->setCommisionPercentage($pay['CommissionPer']);      # set commission in %
            $form->getObject()->setCommisionActual($pay['ActualCommission']);       # set Acutal commission
            $form->getObject()->setProcessingFees($pay['ProcessingFee']);           # set the processing fee
            $form->getObject()->setPayableAmount($pay['PayableAmt']);               # set the payable amt
            $form->getObject()->setStage(sfConfig::get('app_CaseStage_Accepted'));
            $form->getObject()->setAgreementDate($agreementDate);
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
            $actDesc .= $this->getUser()->getAttribute('admin_firstname').' '.$this->getUser()->getAttribute('admin_lastname').' has submitted case.';
            $actDesc .= "\n";
            #$actDesc .= "<u>Case Detail:</u>";
            #$actDesc .= "\n";
            $actDesc .= "Case No.: ".$caseNo;
            $actDesc .= "\n";
            $actDesc .= "3rd Party: ".$cases->getCasesThirdParties()->getName();
            $actDesc .= "\n";
            $actDesc .= "Case Actual Amount: ".sfConfig::get('app_currency').$cases->getActualAmount() ;
            $actDesc .= "\n";
            $actDesc .= "Commission Percentage :".$cases->getCommisionPercentage().'%';
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


            // For Case Accepted - CaseAccepted
            $actDesc1 = '';
            $actDesc1 .= $cases->getCaseNo().' - '.$cases->getFirstTitle().' '.$cases->getLastTitle().' case has been accepted.';
            $actDesc1 .= "\n";
            $actDesc1 .= "Case No.: ".$caseNo;
            $actDesc1 .= "\n";
            $actDesc1 .= "Agreement Date: ".date(sfConfig::get('app_dateformat'),strtotime($cases->getAgreementDate())) ;
            $actDesc1 .= "\n";
            $actDesc1 .= "3rd Party: ".$cases->getCasesThirdParties()->getName();
            $actDesc1 .= "\n";
            $actDesc1 .= "Case Actual Amount: ".$cases->getActualAmount() ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Commission Percentage :".$cases->getCommisionPercentage().'%' ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Commission: ".sfConfig::get('app_currency').$cases->getCommisionActual() ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Processing Fee: ".sfConfig::get('app_currency').$cases->getProcessingFees() ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Payable Amount: ".sfConfig::get('app_currency').$cases->getPayableAmount() ;
            $actDesc1 .= "\n";

            $activityArr1 = array();
            $activityArr1['CaseId'] = $caseId ;
            $activityArr1['ActivityType'] = sfConfig::get('app_CaseActivityType_CaseAccepted') ;
            $activityArr1['Description'] = $actDesc1 ;
            $caseActivity1 = new CaseActivities();
            $caseActivity1->saveActivity($activityArr1);

            // Code Complete To Add Case to Activity Log

            // Add To Case Activity
            /*$caseActivity = new CaseActivities();
            $caseActivity->setCaseId($caseId);
            $caseActivity->setActivityType(sfConfig::get('app_CaseActivityType_CustomerBillsSubmitted'));
            $caseActivity->save();*/

            // Send Case Creation alert From Admin To Customer
            $arrParams = array();
            $arrParams['CustomerEmail'] = $cases->getCasesUsers()->getEmail();
            $arrParams['CustomerName'] = $cases->getCasesUsers()->getFirstName().' '.$cases->getCasesUsers()->getLastName();
            $arrParams['CaseNo'] = $cases->getCaseNo();
            $arrParams['CaseTitle'] = $cases->getFirstTitle().' '.$cases->getLastTitle();
            $arrParams['CaseAcceptedDate'] = date('Y-m-d', strtotime($cases->getAgreementDate()));
            #clsCommon::pr($arrParams);
            #die;
            $objSiteMail = new siteMails();
            $objSiteMail->sendAdminCreatedCaseEmailToCustomer($arrParams);
            // Mail code Complete

            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "New case added successfully.");

            $this->redirect('case/index');
            // } // End of If Has Error

        } // End of if Valid

    } // End of Function


    protected function processEditForm(sfWebRequest $request, sfForm $form , $oldCaseDetail)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $case = $request->getParameter($form->getName()) ;
        if ($form->isValid())
        {
            # here commission calcution function exist in clscommon
            $pay = clsCommon::commissionCalculation($case['ActualAmount']);
            $form->getObject()->setCommisionPercentage($pay['CommissionPer']);      # set commission in %
            $form->getObject()->setCommisionActual($pay['ActualCommission']);       # set Acutal commission
            $form->getObject()->setProcessingFees($pay['ProcessingFee']);           # set the processing fee
            $form->getObject()->setPayableAmount($pay['PayableAmt']);               # set the payable amt

            if($oldCaseDetail->getStage() == sfConfig::get('app_CaseStage_Submitted')){
                $form->getObject()->setStage(sfConfig::get('app_CaseStage_Accepted'));
            }
            $cases = $form->save();

            // If Admin Goes in edit to check Case submitted by Customer, and case still in Submited mode then on edit mode he selects Agreement date then make Case as Accepted and make activity log for the same.
            if($oldCaseDetail->getStage() == sfConfig::get('app_CaseStage_Submitted')){

                // For Case Accepted - CaseAccepted
                $actDesc1 = '';
                $actDesc1 .= $cases->getCaseNo().' - '.$cases->getFirstTitle().' '.$cases->getLastTitle().' case has been accepted.';
                $actDesc1 .= "\n";
                $actDesc1 .= "Case No.: ".$cases->getCaseNo();
                $actDesc1 .= "\n";
                $actDesc1 .= "Agreement Date: ".date(sfConfig::get('app_dateformat'),strtotime($cases->getAgreementDate())) ;
                $actDesc1 .= "\n";
                $actDesc1 .= "3rd Party: ".$cases->getCasesThirdParties()->getName();
                $actDesc1 .= "\n";
                $actDesc1 .= "Case Actual Amount: ".$cases->getActualAmount() ;
                $actDesc1 .= "\n";
                $actDesc1 .= "Commission Percentage :".$cases->getCommisionPercentage().'%' ;
                $actDesc1 .= "\n";
                $actDesc1 .= "Commission: ".sfConfig::get('app_currency').$cases->getCommisionActual() ;
                $actDesc1 .= "\n";
                $actDesc1 .= "Processing Fee: ".sfConfig::get('app_currency').$cases->getProcessingFees() ;
                $actDesc1 .= "\n";
                $actDesc1 .= "Payable Amount: ".sfConfig::get('app_currency').$cases->getPayableAmount() ;
                $actDesc1 .= "\n";

                $activityArr1 = array();
                $activityArr1['CaseId'] = $cases->getId() ;
                $activityArr1['ActivityType'] = sfConfig::get('app_CaseActivityType_CaseAccepted') ;
                $activityArr1['Description'] = $actDesc1 ;
                $caseActivity1 = new CaseActivities();
                $caseActivity1->saveActivity($activityArr1);
            }

            $this->getUser()->setFlash('succMsg', "Update successful.");
            $this->redirect('case/index');
            //  } // End of If Has Error

        } // End of if Valid

    } // End of Function

    /**
     * Function To Download Case Document
     */    
    public function executeDownloadinvoice(sfWebRequest $request) {
        $caseId = $request->getParameter('id');


        $caseDetail = CasesTable::getCaseDetail($caseId);
        #clsCommon::pr($caseDetail);

        $orgName = $caseDetail['BillDocumentRealName'];
        $sysName = $caseDetail['BillDocumentSystemName'];

        // For Linux
        #$source = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_caseInvoicePath').$sysName ;
        $source = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_caseInvoicePath').$sysName; //GET Case Invoice Path
        # $caseInvoicePath.$sysName;
        #die;

        // For Windows
        /*$source = trim(sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_caseInvoicePath'),'/');
        $source .= '\\'.$sysName; */

        if (file_exists($source)){

            header("Pragma: ");
            header("Cache-Control: ");
            header("Content-type: application/force-download");
            header('Content-Disposition: inline; filename="' .$source.''. '"');
            header("Content-Transfer-Encoding: Binary");
            header("Content-length: ".filesize($source));
            header('Content-Type: application/octet-stream');

            header('Content-Disposition: attachment; filename="'.$orgName.'"');
            readfile("$source");
            exit();
        }
        exit();
    } // End of function


    /**
     * Function To Remove Case Document
     */    
    public function executeRemoveinvoice(sfWebRequest $request) {
        $caseId = $request->getParameter('id');
        $type = $request->getParameter('type');
        $caseDetail = CasesTable::getCaseDetail($caseId);
        #clsCommon::pr($caseDetail);



        $orgName = $caseDetail['BillDocumentRealName'];
        $sysName = $caseDetail['BillDocumentSystemName'];

        $caseInvoicePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_caseInvoicePath'); //GET Case Invoice Path
        @unlink($caseInvoicePath.$sysName);

        $sql = Doctrine_Query::create()
        ->update('Cases c')
        ->set('c.BillDocumentRealName',"NULL ")
        ->set('c.BillDocumentSystemName',"NULL")
        ->where('c.Id = ? ', $caseId)
        ->execute();

        $this->getUser()->setFlash('succMsg', "Deletion successful.");

        /*if($this->getUser()->hasCredential('admin') || $this->getUser()->hasCredential('staff')) {
        $this->redirect('case/edit?id='.$caseId);
        } else { // For Customer
        $this->redirect('customercase/edit?id='.$caseId);
        }*/

        if($type == 'customer') {
            $this->redirect('customercase/edit?id='.$caseId);
        } else {
            $this->redirect('case/edit?id='.$caseId);
        }

    } // End of function

    /**
     * Function To Change Case Status to Active / Inactive / Deleted
     */    
    public function executeChangeStatus(sfWebRequest $request)
    {
        $this->forward404Unless($cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), sprintf('Case not found!'));
        $status = $request->getParameter('status');

        // Do not allow to change status of current user
        if (in_array($status,array(sfConfig::get('app_CaseStatus_Active'),sfConfig::get('app_CaseStatus_Inactive'), sfConfig::get('app_CaseStatus_Deleted'))) && $cases->getStage() != sfConfig::get('app_CaseStage_Close'))   {
            $cases->setStatus($status);
            $cases->setUpdateDateTime(date("Y-m-d H:i:s"));
            $cases->save();
            $arrParams = array();

            if($status == sfConfig::get('app_CaseStatus_Active') ){
                $this->getUser()->setFlash("succMsg",'Status successfully changed to Active.');
                //$arrParams['Status'] = sfConfig::get('app_CaseStatus_Active');

            } else if($status == sfConfig::get('app_CaseStatus_Inactive')) {
                $this->getUser()->setFlash("errMsg",'Status successfully changed to Inactive.');
                //$arrParams['Status'] = sfConfig::get('app_CaseStatus_Inactive');

            } else if ($status == sfConfig::get('app_CaseStatus_Deleted')){
                $this->getUser()->setFlash("errMsg",'Deletion successful.');
                //$arrParams['Status'] = sfConfig::get('app_CaseStatus_Deleted');
            }

        } else {
            $this->getUser()->setFlash("errMsg",'Closed cases cannot be deleted. ');
        }
        $this->redirect('case/index');
    }

    public function executeView(sfWebRequest $request)
    {
        // DISPLAY 404 PAGE IF FAQ NOT EXIST.
        $this->forward404Unless($this->case = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), 'Faqs does not exist.');
    }


    /**
     * Function to Get User Specific Case
     *
     * @param sfWebRequest $request
     */
    public function executeUsercase(sfWebRequest $request) {
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


        $this->caseArr = CasesTable::getAllCaseNo($userId, $stageArr);
        #clsCommon::pr($this->caseArr);

    } // End of Function

    /**
     * Function To Change Case Stage to Submitted / Paid / Close
     */    
    public function executeChangestage(sfWebRequest $request)
    {
        $this->forward404Unless($cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), sprintf('Case not found!'));
        $stage = $request->getParameter('stage');


        if (in_array($stage,array(sfConfig::get('app_CaseStage_Accepted'),sfConfig::get('app_CaseStage_Paid'), sfConfig::get('app_CaseStage_Close')))){

            if($stage == sfConfig::get('app_CaseStage_Accepted') ){

                $acceptedDate = date("Y-m-d") ;
                $cases->setAgreementDate($acceptedDate);
                $cases->setStage($stage);
                $cases->setUpdateDateTime(date("Y-m-d H:i:s"));
                $cases->save();

                // Add To Case Activity - CaseSubmitted
                $actDesc1 = '';
                $actDesc1 .= $cases->getCaseNo().' - '.$cases->getFirstTitle().' '.$cases->getLastTitle().' case has been accepted.';
                $actDesc1 .= "\n";
                #$actDesc .= "<u>Case Detail:</u>";
                #$actDesc .= "\n";
                $actDesc1 .= "CaseNo.: ".$cases->getCaseNo();
                $actDesc1 .= "\n";
                $actDesc1 .= "Agreement Date: ".date(sfConfig::get('app_dateformat'),strtotime($cases->getAgreementDate())) ;
                $actDesc1 .= "\n";
                $actDesc1 .= "3rd Party: ".$cases->getCasesThirdParties()->getName();
                $actDesc1 .= "\n";
                $actDesc1 .= "Case Amount: ".sfConfig::get('app_currency').$cases->getActualAmount() ;
                // Activity Complete

                $activityArr1 = array();
                $activityArr1['CaseId'] = $cases->getId() ;
                $activityArr1['ActivityType'] = sfConfig::get('app_CaseActivityType_CaseAccepted') ;
                $activityArr1['Description'] = $actDesc1 ;
                $caseActivity1 = new CaseActivities();
                $caseActivity1->saveActivity($activityArr1);
                // Code Complete

                $this->getUser()->setFlash("succMsg",'Status successfully changed to Accepted.');

                // Send Case Accepted alert From Admin To Customer
                $arrParams = array();
                $arrParams['CustomerEmail'] = $cases->getCasesUsers()->getEmail();
                $arrParams['CustomerName'] = $cases->getCasesUsers()->getFirstName().' '.$cases->getCasesUsers()->getLastName();
                $arrParams['CaseNo'] = $cases->getCaseNo();
                $arrParams['CaseTitle'] = $cases->getFirstTitle().' '.$cases->getLastTitle();
                $arrParams['CaseAcceptedDate'] = $acceptedDate;
                #clsCommon::pr($arrParams);
                $objSiteMail = new siteMails();
                $objSiteMail->sendAdminAcceptedCaseEmailToCustomer($arrParams);
                // Mail code Complete


            } else if($stage == sfConfig::get('app_CaseStage_Paid')) {
                $this->getUser()->setFlash("succMsg",'Status successfully changed to Paid.');

            } else if ($stage == sfConfig::get('app_CaseStage_Close')){
                $this->getUser()->setFlash("succMsg",'Status successfully changed to Close.');
            }

        }
        $this->redirect('case/index');
    }

    public function executePrintinvoice(sfWebRequest $request) {

        $cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id')));
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        // pdf object
        $pdf = new sfTCPDF();

		$wordCounceledge = clsCommon::getSystemConfigVars('SITE_NAME');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($wordCounceledge);
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
        if ($cases->getCasesUsers()->getAddress1() != "") {
            $pdf->Cell(100, 5,$cases->getCasesUsers()->getAddress1(),'','','R');
            $pdf->Ln(6);
        }

        if ($cases->getCasesUsers()->getAddress2() != "") {
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
        $pdf->Cell(100, 5,$cases->getCasesThirdParties()->getName(),'','','R');
        $pdf->Ln(6);

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
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('example_001.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    /**
     * Function To Submit bills to 3rd PArty
     */    
    public function executeSubmitbill(sfWebRequest $request)
    {
        $this->forward404Unless($cases = Doctrine::getTable('Cases')->find(array($request->getParameter('id'))), sprintf('Case not found!'));

        if($cases->getStage() == sfConfig::get('app_CaseStage_Accepted') || $cases->getStage() == sfConfig::get('app_CaseStage_Paid') ) {

            $status = $request->getParameter('stat');

            if($status == 'Yes')  {
                $cases->setThirdPartyBillsSubmitted('Yes');
            } else if($status == 'No') {
                $cases->setThirdPartyBillsSubmitted('No');
            } else  {
                $cases->setThirdPartyBillsSubmitted('Yes');
            }

            $cases->setUpdateDateTime(date("Y-m-d H:i:s"));
            $cases->save();

            // Add To Case Activity - 3rdPartyBillsSubmitted
            $actDesc1 = '';

            if($status == 'No')
            $actDesc1 .= $cases->getCaseNo().' - '.$cases->getFirstTitle().' '.$cases->getLastTitle().' case bills have been rejected to 3rd Party '.$cases->getCasesThirdParties()->getName().'.';
            else
            $actDesc1 .= $cases->getCaseNo().' - '.$cases->getFirstTitle().' '.$cases->getLastTitle().' case bills have been submitted to 3rd Party '.$cases->getCasesThirdParties()->getName().'.';

            $actDesc1 .= "\n";
            $actDesc1 .= "Case No.: ".$cases->getCaseNo();
            $actDesc1 .= "\n";
            $actDesc1 .= "3rd Party: ".$cases->getCasesThirdParties()->getName();
            $actDesc1 .= "\n";
            $actDesc1 .= "Case Amount: $".$cases->getActualAmount() ;
            // Activity Complete

            $activityArr1 = array();
            $activityArr1['CaseId'] = $cases->getId() ;
            if($status == 'No')
                $activityArr1['ActivityType'] = sfConfig::get('app_CaseActivityType_3rdPartyBillsRejected') ;
            else 
                $activityArr1['ActivityType'] = sfConfig::get('app_CaseActivityType_3rdPartyBillsSubmitted') ;
            $activityArr1['Description'] = $actDesc1 ;
            $caseActivity1 = new CaseActivities();
            $caseActivity1->saveActivity($activityArr1);
            // Code Complete

            if($status == 'No')
            $this->getUser()->setFlash("errMsg",'Case status reverted to unbilled to 3rd party.');
            else
            $this->getUser()->setFlash("succMsg",'Case status set to billed to 3rd party.');
        } else {
            $this->getUser()->setFlash("errMsg",'Submitted or Closed Case Bills can not be taken.');
        }
        
        $this->redirect('case/index');

    }

    /**
     * Function to delete case permanent 
     *
     * @param sfWebRequest $request
     */
    public function executePermanentDeleteCase(sfWebRequest $request)
    {
        if($request->hasParameter("id") && $request->hasParameter("flag"))
        {
            $id = $request->getParameter("id");
            $cases = Doctrine::getTable('Cases')->find($id);

            if($cases->getStage() == sfConfig::get('app_CaseStage_Submitted') ) { // Only Submitted case will be deleted

                /* remove data from caseDocument table */
                $caseDocuments = Doctrine::getTable('CaseDocuments')->findByCaseId($id);
                $directoryPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_caseInvoicePath').$id.DIRECTORY_SEPARATOR;
                $this->deleteDir($directoryPath);
                $caseDocuments->delete();

                /* remove data from CaseActivities table */
                $caseActivities = Doctrine::getTable('CaseActivities')->findByCaseId($id);
                $caseActivities->delete();

                /* remove data from CustomerPaymentSent table */
                $customerPaymentSent = Doctrine::getTable('CustomerPaymentSent')->findByCaseId($id);
                $customerPaymentSent->delete();

                /* remove data from ThirdPartyPaymentReceived table */
                $thirdPartyPaymentReceived = Doctrine::getTable('ThirdPartyPaymentReceived')->findByCaseId($id);
                $thirdPartyPaymentReceived->delete();

                /* remove data from Cases table */

                $cases->delete();

                if($request->getParameter("flag") == 1)
                $this->redirect("case/index");
                if($request->getParameter("flag") == 2)
                $this->redirect("dashboardcase/index?customerId=".$request->getParameter("customerId"));

            } else { // Once Case Accepted then it can not be deleted
                $this->getUser()->setFlash("errMsg",'Once case accepted, it can not be deleted.');
                if($request->getParameter("flag") == 1)
                $this->redirect("case/index");
                if($request->getParameter("flag") == 2)
                $this->redirect("dashboardcase/index?customerId=".$request->getParameter("customerId"));

            } // Not Submitted
        }
    }
    public function deleteDir($dir)
    {
        if ($handle = opendir($dir))
        {
            $array = array();

            while (false !== ($file = readdir($handle)))
            {
                if ($file != "." && $file != "..")
                {

                    if(is_dir($dir.$file))
                    {
                        if(!@rmdir($dir.$file)) // Empty directory? Remove it
                        {
                            //deleteDir($dir.$file.'/'); // Not empty? Delete the files inside it
                        }
                    }
                    else
                    {
                        @unlink($dir.$file);
                    }
                }
            }
            closedir($handle);
            @rmdir($dir);
        }
    }
} // End of Class
