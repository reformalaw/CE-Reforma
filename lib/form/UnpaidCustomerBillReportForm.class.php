<?php
/**
 * This form is used for Global Report , Unpaid bills to Customer Report
 *
 */

class UnpaidCustomerBillReportForm extends BaseCasesForm {

    public function configure() {
        parent::configure();

        #$custArr = UsersTable::getCustomers();
        $custArr = UsersTable::getCustomersForFinanceReport();

        $this->setWidgets(array(
        'UserId'     => new sfWidgetFormSelect(array('choices' =>  array( '' => 'Select Customer') + $custArr), array('style'=>'width:200px;')),
        'StartAmount'=> new sfWidgetFormInput(array(),array('style'=>'width:100px;')),
        'EndAmount'  => new sfWidgetFormInput(array(),array('style'=>'width:100px;'))
        ));

        $this->widgetSchema->setLabels(array(
        'UserId'	  => 'Select Customer',
        'StartAmount' => 'Enter Actual Amount Range',
        ));


        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search[%s]');
    }
}
?>