<?php
/**
 * This form is used for Customer Transaction Report Global Report , Unpaid bills to Customer Report
 *
 */

class PaymentReportForm extends BaseCasesForm {

    public function configure() {
        parent::configure();

        $userId = $this->getOption('userId');
        $caseArr = CasesTable::GetCustomerPaidCases($userId);

        $yearRange = "'1990:".date("Y") ."'";

        $stageArr  = array(
        sfConfig::get('app_CaseStage_Paid')      => sfConfig::get('app_CaseStage_Paid') ,
        sfConfig::get('app_CaseStage_Close')     => sfConfig::get('app_CaseClosed_Closed')
        //sfConfig::get('app_CaseStage_Close')     => sfConfig::get('app_CaseStage_Close')

        );


        $this->setWidgets(array(
        'CaseNo'	=> new sfWidgetFormInputText(array(),  array('style'=>'width:200px;')),
        #'UserCaseNo' => new sfWidgetFormSelect(array('choices'=> array( '' => 'Select Case No') + $caseArr), array('style'=>'width:200px;')),
        'FromDate' 	 => new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange)),
        'ToDate'	 => new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange)),
        'StartAmount'=> new sfWidgetFormInput(array(),array('style'=>'width:100px;')),
        'EndAmount'  => new sfWidgetFormInput(array(),array('style'=>'width:100px;')),
        'Stage'      => new sfWidgetFormSelect(array('choices'=> array( '' => 'Select Case Stage') + $stageArr), array('style'=>'width:200px;')),        
        ));

        $this->widgetSchema->setLabels(array(
        #'UserCaseNo'  => 'Select Case No.',
        'CaseNo'      => 'Case No.',
        'FromDate'	  => 'Select Payment Received Date',
        'ToDate'	  => 'To Date',
        'StartAmount' => 'Enter Actual Amount Range',
        'Stage'	      => 'Select Case Stage',
        ));


        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search[%s]');
    }
}
?>