<?php

class SearchDashboardAdminCaseForm extends BaseCasesForm {


    public static $searchText = array('' => 'Select One','FirstName' => 'Name','Email' => 'Email');


    public function configure() {
        parent::configure();
        
        
        $userId = $this->getOption('UserId');         
        
        $custArr = UsersTable::getCustomers();
        $caseArr = CasesTable::getAllCaseNo($userId);
        
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
        #'UserId'	=> new sfWidgetFormSelect(array('choices' =>  array( '' => 'Select Customer') + $custArr), array('style'=>'width:200px;')),
        'CaseNo'	=> new sfWidgetFormInputText(array(),  array('style'=>'width:200px;')),
       # 'UserCaseNo'=> new sfWidgetFormSelect(array('choices'=> array( '' => 'Select Case No') + $caseArr), array('style'=>'width:200px;')),
        
	    'FromDate'			=> new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange)),
	    'ToDate'			=> new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange)),
        
        
        'Stage'=> new sfWidgetFormSelect(array('choices'=> array( '' => 'Select Case Stage') + $stageArr), array('style'=>'width:200px;')),        
        'Status'=> new sfWidgetFormSelect(array('choices'=> array( '' => 'Select Status') + $statusArr), array('style'=>'width:200px;')),        
        
        ));

        $this->widgetSchema->setLabels(array(
        #'UserId'	  => 'Select Customer',
        'CaseNo'	  => 'Case No.',
     #   'UserCaseNo'  => 'Select Case No.',
        'FromDate'	  => 'Agreement Date',
        'ToDate'	  => 'To Date',
        'Stage'	      => 'Select Case Stage',
        'Status'	  => 'Select Case Status'
        
        ));

        /*$this->setValidators(array(
        'search_text'       => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>50),array('required'=>'Please Enter First Name','min_length'=>'Please Enter More than 3 characters','max_length'=>'Please Enter Less than 50 characters')),
        'field_type'        => new sfValidatorChoice(array('required' => true,'choices'=>self::$searchText)),
        ));*/

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search_admin_case[%s]');
    }
}
?>