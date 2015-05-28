<?php

/**
 * paymentreceived actions.
 *
 * @package    counceledge
 * @subpackage paymentreceived
 * @author     Chintan Fadia
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class paymentreceivedActions extends sfActions
{

    /**
	 * preExecutes index action
	 */
    public function preExecute()
    {
        $this->setLayout("dashboard");
        $request = $this->getRequest();
        $this->customerId = $request->getParameter('customerId');
        $this->caseId = $request->getParameter('caseId');
    }


    public function executeIndex(sfWebRequest $request)
    {

        $this->customerId = $request->getParameter('customerId');
        $this->caseId = $request->getParameter('caseId');
        $this->caseObj = Doctrine::getTable('Cases')->find(array($this->caseId)); // Get Case Detail

        // If Any Submited Case Comes From Direct URL Then Redirect to Summary Page
        if($this->caseObj->getStage() == sfConfig::get('app_CaseStage_Submitted')) {
            $this->getUser()->setFlash('errMsg', "Payment history will be available once case is accepted.");
            $this->redirect('dashboardcase/dashboardCaseDetails?customerId='.$this->customerId.'&caseId='.$this->caseId);
        }

        $qSearch = Doctrine_Query::create();
        $qSearch->from('ThirdPartyPaymentReceived th');
        $qSearch->where('th.CaseId = ? ', $this->caseId);
        $qSearch->orderBy('th.PaymentReceivedDate');
        $pager = new sfDoctrinePager('ThirdPartyPaymentReceived', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

        $this->form = new ThirdPartyPaymentReceivedForm(); // Log Received Form
    }
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new ThirdPartyPaymentReceivedForm();
    }

    public function executeCreate(sfWebRequest $request)
    {

        $this->customerId = $request->getParameter('customerId');
        $this->caseId = $request->getParameter('caseId');
        $this->caseObj = Doctrine::getTable('Cases')->find(array($this->caseId)); // Get Case Detail

        // Check Payment can not be made for Cloase case
        if($this->caseObj->getStage() == sfConfig::get('app_CaseStage_Close')) {
            $this->getUser()->setFlash('errMsg', "Once case closed 3rd party payments will not be updated.");
            $this->redirect('paymentreceived/index?customerId='.$this->customerId.'&caseId='.$this->caseId);
        }

        $qSearch = Doctrine_Query::create();
        $qSearch->from('ThirdPartyPaymentReceived th');
        $qSearch->where('th.CaseId = ? ', $this->caseId);
        $qSearch->orderBy('th.CreateDateTime DESC');
        $pager = new sfDoctrinePager('ThirdPartyPaymentReceived', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new ThirdPartyPaymentReceivedForm();
        $this->processForm($request, $this->form);
        $this->setTemplate('index');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($third_party_payment_received = Doctrine::getTable('ThirdPartyPaymentReceived')->find(array($request->getParameter('id'),
        $request->getParameter('caseId'))), sprintf('Object does not exist (%s).', $request->getParameter('id'),
        $request->getParameter('caseId')));
        $this->form = new ThirdPartyPaymentReceivedForm($third_party_payment_received);
        $this->form->setDefault('PaymentReceivedDate',date('m/d/Y', strtotime($third_party_payment_received->getPaymentReceivedDate())) );

        $this->customerId = $request->getParameter('customerId');
        $this->caseId = $request->getParameter('caseId');
        $this->caseObj = Doctrine::getTable('Cases')->find(array($this->caseId));        // Get Case Detail

        // Check Payment can not be made for Cloase case
        if($this->caseObj->getStage() == sfConfig::get('app_CaseStage_Close')) {
            $this->getUser()->setFlash('errMsg', "Once case closed 3rd party payments will not be updated.");
            $this->redirect('paymentreceived/index?customerId='.$this->customerId.'&caseId='.$this->caseId);
        }

        $qSearch = Doctrine_Query::create();
        $qSearch->from('ThirdPartyPaymentReceived th');
        $qSearch->where('th.CaseId = ? ', $this->caseId);
        $qSearch->orderBy('th.CreateDateTime DESC');
        $pager = new sfDoctrinePager('ThirdPartyPaymentReceived', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

        $this->setTemplate('index');
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($third_party_payment_received = Doctrine::getTable('ThirdPartyPaymentReceived')->find(array($request->getParameter('id'),
        $request->getParameter('caseId'))), sprintf('Object does not exist (%s).', $request->getParameter('id'),
        $request->getParameter('caseId')));
        $this->form = new ThirdPartyPaymentReceivedForm($third_party_payment_received);
        $this->form->setDefault('PaymentReceivedDate',date('m/d/Y', strtotime($third_party_payment_received->getPaymentReceivedDate())) );


        $this->customerId = $request->getParameter('customerId');
        $this->caseId = $request->getParameter('caseId');
        $this->caseObj = Doctrine::getTable('Cases')->find(array($this->caseId));        // Get Case Detail

        // Check Payment can not be made for Close case
        if($this->caseObj->getStage() == sfConfig::get('app_CaseStage_Close')) {
            $this->getUser()->setFlash('errMsg', "Once case closed 3rd party payments will not be updated.");
            $this->redirect('paymentreceived/index?customerId='.$this->customerId.'&caseId='.$this->caseId);
        }

        $qSearch = Doctrine_Query::create();
        $qSearch->from('ThirdPartyPaymentReceived th');
        $qSearch->where('th.CaseId = ? ', $this->caseId);
        $qSearch->orderBy('th.CreateDateTime DESC');
        $pager = new sfDoctrinePager('ThirdPartyPaymentReceived', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;


        $this->processEditForm($request, $this->form, $third_party_payment_received);

        $this->setTemplate('index');
    }

    public function executeDelete(sfWebRequest $request)
    {

        $customerId = $request->getParameter('customerId');
        $caseId = $request->getParameter('caseId');

        $this->forward404Unless($third_party_payment_received = Doctrine::getTable('ThirdPartyPaymentReceived')->find(array($request->getParameter('id'),
        $request->getParameter('caseId'))), sprintf('Object does not exist (%s).', $request->getParameter('id'),
        $request->getParameter('caseId')));

        // Update Case Table
        $cases = Doctrine::getTable('Cases')->find(array($caseId));
        
        // Check Payment can not be made for Close case
        if($cases->getStage() == sfConfig::get('app_CaseStage_Close')) {
            $this->getUser()->setFlash('errMsg', "Once case closed 3rd party payments will not be updated.");
            $this->redirect('paymentreceived/index?customerId='.$customerId.'&caseId='.$caseId);
        }
        
        $cases->setReceivedAmount($cases->getReceivedAmount() - $third_party_payment_received->getReceivedAmount() );
        $cases->setRemainToReceive($cases->getRemainToReceive() + $third_party_payment_received->getReceivedAmount());
        $cases->save();

        // Delete 3rd Party
        $third_party_payment_received->delete();
        $this->getUser()->setFlash('errMsg', "Deletion successful.");
        $this->redirect('paymentreceived/index?customerId='.$customerId.'&caseId='.$caseId);

    } // End of Functon

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $customerId = $request->getParameter('customerId');
        $caseId = $request->getParameter('caseId');

        if ($form->isValid())
        {

            $paymentArr = $request->getParameter($form->getName());
            $caseDetail = Doctrine::getTable('Cases')->find(array($caseId));

            $paymentRecdPaidDate = date('Y-m-d', strtotime($paymentArr['PaymentReceivedDate']));
            unset($form['PaymentReceivedDate']);

            #clsCommon::pr($paymentArr,1);

            // Save Third Party Payment Recd
            $form->getObject()->setThirdParty($caseDetail->getThirdParty());
            $form->getObject()->setCaseId($caseId);
            $form->getObject()->setCaseNo($caseDetail->getCaseNo());
            $form->getObject()->setPaymentReceivedDate($paymentRecdPaidDate);
            $third_party_payment_received = $form->save();


            // Update Case Table
            $caseDetail->setPaymentReceivedDate($third_party_payment_received->getPaymentReceivedDate());
            $caseDetail->setReceivedAmount($caseDetail->getReceivedAmount() + $paymentArr['ReceivedAmount']);
            $caseDetail->setRemainToReceive($caseDetail->getActualAmount() - $caseDetail->getReceivedAmount() );
            $caseDetail->save();


            // Add To Case Activity - PaymentReceived
            $actDesc1 = '';
            $actDesc1 .= $caseDetail->getCaseNo().' - '.$caseDetail->getFirstTitle().' '.$caseDetail->getLastTitle().' case payment has been received from 3rd Party '.$caseDetail->getCasesThirdParties()->getName().'.';
            $actDesc1 .= "\n";
            $actDesc1 .= "Case No.: ".$caseDetail->getCaseNo();
            $actDesc1 .= "\n";
            $actDesc1 .= "3rd Party: ".$caseDetail->getCasesThirdParties()->getName();
            $actDesc1 .= "\n";
            $actDesc1 .= "Received Amount: ".sfConfig::get('app_currency').$third_party_payment_received->getReceivedAmount() ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Received Date: ".date('Y-m-d',strtotime($third_party_payment_received->getPaymentReceivedDate())) ;

            $activityArr1 = array();
            $activityArr1['CaseId'] = $caseId ;
            $activityArr1['ActivityType'] = sfConfig::get('app_CaseActivityType_PaymentReceived') ;
            $activityArr1['Description'] = $actDesc1 ;
            $caseActivity1 = new CaseActivities();
            $caseActivity1->saveActivity($activityArr1);
            // Code complete


            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "Payment received successfully.");

            $this->redirect('paymentreceived/index?customerId='.$customerId.'&caseId='.$caseId);

        }
    }


    protected function processEditForm(sfWebRequest $request, sfForm $form,  $oldValObj )
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $customerId = $request->getParameter('customerId');
        $caseId = $request->getParameter('caseId');

        if ($form->isValid())
        {

            $paymentArr = $request->getParameter($form->getName());
            $oldValues = $oldValObj->toArray();
            $caseDetail = Doctrine::getTable('Cases')->find(array($caseId));

            $paymentRecdPaidDate = date('Y-m-d', strtotime($paymentArr['PaymentReceivedDate']));
            unset($form['PaymentReceivedDate']);

            $form->getObject()->setPaymentReceivedDate($paymentRecdPaidDate);
            $third_party_payment_received = $form->save(); // Save Third Party Payment Recd

            // Update Case Table

            $caseDetail->setPaymentReceivedDate($third_party_payment_received->getPaymentReceivedDate());
            $caseDetail->setReceivedAmount( ( $caseDetail->getReceivedAmount() - $oldValues['ReceivedAmount'] ) + $paymentArr['ReceivedAmount']);
            $caseDetail->setRemainToReceive( ($caseDetail->getRemainToReceive() + $oldValues['ReceivedAmount'] )- $paymentArr['ReceivedAmount']);
            $caseDetail->save();

            // Add To Case Activity - PaymentReceived
            $actDesc1 = '';
            $actDesc1 .= $caseDetail->getCaseNo().' - '.$caseDetail->getFirstTitle().' '.$caseDetail->getLastTitle().' case updated payment has been received from 3rd Party '.$caseDetail->getCasesThirdParties()->getName().'.';
            $actDesc1 .= "\n";
            $actDesc1 .= "Case No.: ".$caseDetail->getCaseNo();
            $actDesc1 .= "\n";
            $actDesc1 .= "3rd Party: ".$caseDetail->getCasesThirdParties()->getName();
            $actDesc1 .= "\n";
            $actDesc1 .= "Edited Values:";
            $actDesc1 .= "\n";
            $actDesc1 .= "=================";
            $actDesc1 .= "\n";
            $actDesc1 .= "Received Amount: ".sfConfig::get('app_currency').$third_party_payment_received->getReceivedAmount() ;
            $actDesc1 .= "\n";
            $actDesc1 .= "Received Date: ".date('Y-m-d',strtotime($third_party_payment_received->getPaymentReceivedDate())) ;

            $activityArr1 = array();
            $activityArr1['CaseId'] = $caseId ;
            $activityArr1['ActivityType'] = sfConfig::get('app_CaseActivityType_PaymentReceived') ;
            $activityArr1['Description'] = $actDesc1 ;
            $caseActivity1 = new CaseActivities();
            $caseActivity1->saveActivity($activityArr1);
            // Code complete


            $this->getUser()->setFlash('succMsg', "Update successful.");
            $this->redirect('paymentreceived/index?customerId='.$customerId.'&caseId='.$caseId);

        }
    }  // End of Edit Process Function
}

