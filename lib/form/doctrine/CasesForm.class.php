<?php

/**
 * Cases form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CasesForm extends BaseCasesForm
{
    public function configure()
    {
        parent::configure();

        //COMMENT : UNSET THE DATABASE FIELD NOT PROCESS THROUGH FORM
        unset(
        $this['CaseNo'],
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


        $customerQueryObject = Doctrine::getTable("Users")->getCustomers();     //FOR ASCENDING ORDER USERS
        $tpQueryObject = Doctrine::getTable("ThirdParties")->getThirdParties(); //FOR ASCENDING ORDER Third PArty
        #clsCommon::pr($tpQueryObject);

        #$yearRange = "'1990:".date("Y") ."'";
        $yearRange = sfConfig::get('app_AgreementDate_YearRange');

        $this->setWidgets(array(
        'UserId'                 => new sfWidgetFormChoice(array('choices' =>  array( '' => 'Select') + $customerQueryObject),array('style'=>'width:520px;')),
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
        'UserId'			=> 'Select Customer',
        'Description'	    => 'Case Description',
        'FirstTitle'		=> 'Defendant First Name',
        'LastTitle'			=> 'Defendant Last Name ',
        'ThirdParty'        => 'Select Party ',
        'ActualAmount'		=> 'Case Amount ',
        // 'Document'	        => 'Upload Invoice',
        'AgreementDate'	    => 'Select Agreement Date'
        ));


        $this->setValidators(array(
        'UserId'                 => new sfValidatorString(array('required' => true),array('required' => 'This field is required.')),
        'Description'            => new sfValidatorString(array('required'=> false)),
        'FirstTitle'             => new sfValidatorString(array('required'=>true,'max_length' => 45), array(
        'required'  =>'This field is required.',
        'max_length'=>'Defendants first name cannot be longer than 45 characters.')),

        'LastTitle'              => new sfValidatorString(array('required'=>true,'max_length' => 45), array(
        'required'  =>'This field is required.',
        'max_length'=>'Defendants last name cannot be longer than 45 characters.')),

        'ThirdParty'             => new sfValidatorString(array('required' => true),array('required' => 'This field is required.')),
        # 'ThirdParty'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CasesThirdParties'),'required' => true),array('required' => 'Please select Party')),
        'ActualAmount'           => new sfValidatorNumber(array('required' => true),array('required' => 'This field is required.')),
        //   'Document'               => new sfValidatorFile(array('required' => false),array('required' => 'Please provide Invoice')),
        'AgreementDate'          => new sfValidatorDate(array('required' => true),array('required' => 'This field is required.'))

        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('cases[%s]');



    }
}
