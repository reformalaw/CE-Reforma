<?php

/**
 * Cases form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DashboardCasesForm extends BaseCasesForm
{
    public function configure()
    {
        parent::configure();

        //COMMENT : UNSET THE DATABASE FIELD NOT PROCESS THROUGH FORM
        unset(
        $this['CaseNo'],
        $this['UserId'],
        $this['BillDocumentRealName'],
        $this['BillDocumentSystemName'],
        $this['CommisionPercentage'],
        $this['CommisionActual'],
        $this['ProcessingFees'],
        $this['UnderPayAdjustment'],
        $this['PayableAmount'],
        $this['ReceivedAmount'],
        $this['DifferenceAmount'],
        $this['CustomerPaidDate'],
        $this['PaymentReceivedDate'],
        $this['Stage'],
        $this['Status'],
        $this['UpdateDateTime'],
        $this['CreateDateTime']

        );

        #if($this->getObject()

        $thirdPartyValid  = true ;
        $actualAmtValid = true ;
        if(!$this->isNew()){
            if(sfFormObject::getObject('cases')->getStage() != sfConfig::get('app_CaseStage_Submitted')) {
                $thirdPartyValid  = false ;
                $actualAmtValid = false ;
            }
        }

        $customerQueryObject = Doctrine::getTable("Users")->getCustomers(); //FOR ASCENDING ORDER USERS
        $tpQueryObject = Doctrine::getTable("ThirdParties")->getThirdParties(); //FOR ASCENDING ORDER Third PArty

        #$yearRange = "'1990:".(date("Y")+1)."'";
        $yearRange = sfConfig::get('app_AgreementDate_YearRange');

        $this->setWidgets(array(
        'Description'            => new sfWidgetFormTextarea(array(),array('rows'=>8,'cols'=>80)),
        'FirstTitle'             => new sfWidgetFormInputText(),
        'LastTitle'              => new sfWidgetFormInputText(),
        'ThirdParty'             => new sfWidgetFormChoice(array('choices' =>  array( '' => 'Select') + $tpQueryObject),array('style'=>'width:520px;')),
        'ActualAmount'           => new sfWidgetFormInputText(),
        #'AgreementDate'          => new sfWidgetFormDate(array('can_be_empty'=> false,'default'=>date('m/d/Y'))),
        'AgreementDate'          => new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>$yearRange))
        ));

        //COMMENT : SET THE DEFAULT LABES FOR Customer

        $this->widgetSchema->setLabels(array(
        'Description'	    => 'Case Description',
        'FirstTitle'		=> 'Defendant First Name',
        'LastTitle'			=> 'Defendant Last Name ',
        'ThirdParty'        => 'Select Party ',
        'ActualAmount'		=> 'Case Amount ',
        'AgreementDate'	    => 'Select Agreement Date'
        ));


        $this->setValidators(array(
        'Description'            => new sfValidatorString(array('required'=> false)),
        'FirstTitle'             => new sfValidatorString(array('required'=>true,'max_length' => 45), array(
        'required'  =>'This field is required.',
        'max_length'=>'First name cannot be longer than 45 characters.')),

        'LastTitle'              => new sfValidatorString(array('required'=>true,'max_length' => 45), array(
        'required'  =>'This field is required.',
        'max_length'=>'Last name cannot be longer than 45 characters.')),
        'ThirdParty'             => new sfValidatorString(array('required' => $thirdPartyValid),array('required' => 'This field is required.')),
        'ActualAmount'           => new sfValidatorNumber(array('required' => $actualAmtValid),array('required' => 'This field is required.')),
        'AgreementDate'          => new sfValidatorDate(array('required' => true),array('required' => 'This field is required.'))

        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('cases[%s]');
    }
}
