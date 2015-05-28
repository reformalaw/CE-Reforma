<?php
/**
 * This form is used for Global Report , Unpaid bills from 3rd PArty
 *
 */

class UnpaidThirdPartyBillReportForm extends BaseCasesForm {

    public function configure() {
        parent::configure();

        #$custArr = UsersTable::getCustomers(); // Get All Customers
        $custArr = UsersTable::getCustomersForFinanceReport(); // Get All Customers
        
        $caseArr = CasesTable::GetPaidCases(); // Get Paid Cases

        //FOR ASCENDING ORDER Third PArty
        $tpQueryObject = Doctrine::getTable("ThirdParties")->getThirdParties(); // Get 3rd Parties
        #clsCommon::pr($tpQueryObject);


        $this->setWidgets(array(
        'UserId'     => new sfWidgetFormSelect(array('choices' =>  array( '' => 'Select Customer') + $custArr), array('style'=>'width:200px;')),
        'ThirdParty' => new sfWidgetFormChoice(array('choices' =>  array( '' => 'Select') + $tpQueryObject),array('style'=>'width:200px;')),
        #'UserCaseNo' => new sfWidgetFormSelect(array('choices'=> array( '' => 'Select Case No') + $caseArr), array('style'=>'width:200px;')),
        'CaseNo' => new sfWidgetFormInputText(array(), array('style'=>'width:200px;')),
        
        'StartAmount'=> new sfWidgetFormInput(array(),array('style'=>'width:100px;')),
        'EndAmount'  => new sfWidgetFormInput(array(),array('style'=>'width:100px;'))
        ));

        $this->widgetSchema->setLabels(array(
        'UserId'	  => 'Select Customer',
        'ThirdParty'  => 'Select 3rd Party',
        #'UserCaseNo'  => 'Select Case',
        'CaseNo'  => 'Case No.',
        'StartAmount' => 'Enter Actual Amount Range',
        ));


        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search[%s]');
    }
}
?>