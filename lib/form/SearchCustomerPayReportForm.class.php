<?php

class SearchCustomerPayReportForm extends BaseCasesForm {

    public function configure() {
        parent::configure();

        $userId = $this->getOption('UserId');

        $custArr = UsersTable::getCustomers();
        $stageArr = array(sfConfig::get('app_CaseStage_Paid'), sfConfig::get('app_CaseStage_Close'));
        //clsCommon::pr($stageArr); die;
        #$caseArr = CasesTable::getAllCaseNo($userId, $stageArr);
        $caseArr = CasesTable::getSelectedCases($userId, $stageArr);

        
        /*$amtRange   = array(
        '50-100'  => '50-100',
        '100-150' => '100-150',
        '150-200' => '150-200',
        '200-250' => '200-250',
        '250'     => ' > 250',
        );*/

        $yearRange = "'1990:".date("Y") ."'";

        $this->setWidgets(array(
        'UserId'     => new sfWidgetFormSelect(array('choices' =>  array( '' => 'Select Customer') + $custArr), array('style'=>'width:200px;')),
        #'UserCaseNo' => new sfWidgetFormSelect(array('choices'=> array( '' => 'Select Case No') + $caseArr), array('style'=>'width:250px;')),
        'CaseNo'        => new sfWidgetFormInputText(array(),array('style'=>'width:200px;')),
        'FromDate' 	 => new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange)),
        'ToDate'	 => new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange)),
        #'Amount'    => new sfWidgetFormSelect(array('choices'=> array( '' => 'Select ') + $amtRange), array('style'=>'width:200px;')),
        'StartAmount'=> new sfWidgetFormInput(array(),array('style'=>'width:100px;')),
        'EndAmount'  => new sfWidgetFormInput(array(),array('style'=>'width:100px;'))
        ));

        $this->widgetSchema->setLabels(array(
        'UserId'	  => 'Select Customer',
        #'UserCaseNo'  => 'Select Case No.',
        'CaseNo'      => 'Case No.',
        'FromDate'	  => 'Select Paid Date',
        'ToDate'	  => 'To Date',
        #'Amount'     => 'Enter Paid Amount Range',
        'StartAmount' => 'Enter Paid Amount Range',
        ));


        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search[%s]');
    }
}
?>