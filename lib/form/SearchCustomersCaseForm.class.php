<?php

class SearchCustomersCaseForm extends BaseCasesForm {


    public static $searchText = array('' => 'Select One','FirstName' => 'Name','Email' => 'Email');


    public function configure() {
        parent::configure();


        $userId = $this->getOption('UserId');

        $caseArr = CasesTable::getUserCaseNo($userId);
        $stageArr  = array(
        sfConfig::get('app_CaseStage_Submitted') => sfConfig::get('app_CaseStage_Submitted') ,
        sfConfig::get('app_CaseStage_Accepted')  => sfConfig::get('app_CaseStage_Accepted') ,
        sfConfig::get('app_CaseStage_Paid')      => sfConfig::get('app_CaseStage_Paid') ,
        sfConfig::get('app_CaseStage_Close')     => sfConfig::get('app_CaseClosed_Closed')
        //sfConfig::get('app_CaseStage_Close')     => sfConfig::get('app_CaseStage_Close')

        );


        $statusArr  = array(
        sfConfig::get('app_CaseStatus_Active')   => sfConfig::get('app_CaseStatus_Active') ,
        sfConfig::get('app_CaseStatus_Inactive')  => sfConfig::get('app_CaseStatus_Inactive')

        );

        $yearRange = "'1990:".date("Y") ."'";

        $this->setWidgets(array(
        'CaseNo'	=> new sfWidgetFormInputText(array(),  array('style'=>'width:200px;')),
        #'UserCaseNo'=> new sfWidgetFormSelect(array('choices'=> array( '' => 'Select Case No') + $caseArr), array('style'=>'width:200px;')),

        'FromDate'			=> new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange)),
        'ToDate'			=> new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange)),


        'Stage'=> new sfWidgetFormSelect(array('choices'=> array( '' => 'Select Case Stage') + $stageArr), array('style'=>'width:200px;'))
        ));

        $this->widgetSchema->setLabels(array(
        'CaseNo'	  => 'Case No.',
        #'UserCaseNo'  => 'Select Case No.',
        'FromDate'	  => 'Agreement Date',
        'ToDate'	  => 'To Date',
        'Stage'	      => 'Select Case Stage'
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search_customer_case[%s]');
    }
}
?>