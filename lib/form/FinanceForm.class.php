<?php
// Form For Finance Report
class FinanceForm extends BaseCasesForm {
    
    public function configure() {
        parent::configure();
        
        $custArr = UsersTable::getCustomersForFinanceReport();        
        $yearRange = "'1990:".date("Y") ."'";        
                    
        
        $this->setWidgets(array(
        'UserId'	=> new sfWidgetFormSelect(array('choices' =>  array( '' => 'Select Customer') + $custArr), array('style'=>'width:200px;')),
	    'FromDate'			=> new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange)),
	    'ToDate'			=> new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange)),
        ));

        $this->widgetSchema->setLabels(array(
        'UserId'	  => 'Select Customer',        
        'FromDate'	  => 'Select Case Created Date',
        'ToDate'	  => 'To Date',
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search[%s]');
    }
}
?>