<?php

/**
 * CaseActivities form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Chintan Fadia
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SearchActivityLoggingForm extends BaseCaseActivitiesForm
{
    public function configure()
    {
        parent::configure();

        
        
        $userId = $this->getOption('UserId');         
        if(empty($userId))  {
        	$userId = NULL; 
        }
        $caseArr = CasesTable::getActiveCases($userId);
        
        $activityArr  = array(
        sfConfig::get('app_CaseActivityType_CustomerBillsSubmitted')    => sfConfig::get('app_CaseActivityType_CustomerBillsSubmitted') ,
        sfConfig::get('app_CaseActivityType_CaseAccepted')              => sfConfig::get('app_CaseActivityType_CaseAccepted') ,
        sfConfig::get('app_CaseActivityType_3rdPartyBillsSubmitted')    => sfConfig::get('app_CaseActivityType_3rdPartyBillsSubmitted') ,
        sfConfig::get('app_CaseActivityType_3rdPartyBillsRejected')     => sfConfig::get('app_CaseActivityType_3rdPartyBillsRejected') ,
        sfConfig::get('app_CaseActivityType_CheckSent')                 => sfConfig::get('app_CaseActivityType_CheckSent')
        
        );
        
        if(empty($userId) && $userId == NULL) {
            $activityArr[ sfConfig::get('app_CaseActivityType_PaymentReceived')] =  sfConfig::get('app_CaseActivityType_PaymentReceived'); 
        }      
        #clsCommon::pr($activityArr);

        $yearRange = "'1990:".date("Y") ."'";

        $this->setWidgets(array(
        'ActivityType'  => new sfWidgetFormSelect(array('choices'=> array( '' => 'Select Activity ') + $activityArr), array('style'=>'width:200px;')),
        #'UserCaseNo'    => new sfWidgetFormSelect(array('choices'=> array( '' => 'Select Case No') + $caseArr), array('style'=>'width:250px;')),
        'CaseNo'        => new sfWidgetFormInputText(array(), array('style'=>'width:200px;')),
        'FromDate'		=> new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange)),
        'ToDate'		=> new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange)),
        ));

        $this->widgetSchema->setLabels(array(
        'ActivityType'=> 'Select Activity',
        #'UserCaseNo'  => 'Select Case No.',
        'CaseNo'      => 'Case No.',
        'FromDate'	  => 'Activity Date',
        'ToDate'	  => 'To Date',
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search[%s]');
    }
}
?>