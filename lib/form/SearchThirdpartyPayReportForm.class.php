<?php

class SearchThirdpartyPayReportForm extends BaseCasesForm {

    public function configure() {
        parent::configure();


        //FOR ASCENDING ORDER Third PArty
        $tpQueryObject = Doctrine::getTable("ThirdParties")->getThirdParties();
        #clsCommon::pr($tpQueryObject);
        
        $stageArr = array( sfConfig::get('app_CaseStage_Close'));
        $caseArr = CasesTable::getSelectedCases(NULL, $stageArr);

        $yearRange = "'1990:".date("Y") ."'";

        $this->setWidgets(array(
        'ThirdParty' => new sfWidgetFormChoice(array('choices' =>  array( '' => 'Select') + $tpQueryObject),array('style'=>'width:200px;')),        
        #'UserCaseNo' => new sfWidgetFormSelect(array('choices'=> array( '' => 'Select Case No') + $caseArr), array('style'=>'width:250px;')),
        'CaseNo' => new sfWidgetFormInputText(array(), array('style'=>'width:200px;')),
        'FromDate' 	 => new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange)),
        'ToDate'	 => new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange)),
        'StartAmount'=> new sfWidgetFormInput(array(),array('style'=>'width:100px;')),
        'EndAmount'  => new sfWidgetFormInput(array(),array('style'=>'width:100px;'))
        ));

        $this->widgetSchema->setLabels(array(
        'ThirdParty'  => 'Select 3rd Party',
        #'UserCaseNo'  => 'Select Case No.',
        'CaseNo'      => 'Case No.',
        'FromDate'	  => 'Select Payments Disbursed Date',
        'ToDate'	  => 'To Date',
        'StartAmount' => 'Enter Payments Disbursed Range',
        ));


        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search[%s]');
    }
}
?>