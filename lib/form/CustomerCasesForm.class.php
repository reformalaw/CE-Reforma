<?php

/**
 * Cases form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CustomerCasesForm extends BaseCasesForm
{
    public function configure()
    {
        parent::configure();

        //COMMENT : UNSET THE DATABASE FIELD NOT PROCESS THROUGH FORM
        unset(
        $this['UserId'],
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
        $this['AgreementDate'],
        $this['Stage'],
        $this['Status'],
        $this['UpdateDateTime'],
        $this['CreateDateTime']

        );

        //FOR ASCENDING ORDER Third PArty
        $tpQueryObject = Doctrine::getTable("ThirdParties")->getThirdParties();
        #clsCommon::pr($tpQueryObject);


        $this->setWidgets(array(
        'Description'            => new sfWidgetFormTextarea(array(),array('rows'=>8,'cols'=>80)),
        'FirstTitle'             => new sfWidgetFormInputText(),
        'LastTitle'              => new sfWidgetFormInputText(),
        'ThirdParty'             => new sfWidgetFormChoice(array('choices' =>  array( '' => 'Select') + $tpQueryObject),array('style'=>'width:470px;')),
        'ActualAmount'           => new sfWidgetFormInputText(),
        //'Document'               => new sfWidgetFormInputFile()
        ));

        //COMMENT : SET THE DEFAULT LABES FOR Customer

        $this->widgetSchema->setLabels(array(
        //'UserId'			=> 'Select Customer',
        'Description'	    => 'Case Description',
        'FirstTitle'		=> 'Defendant First Name',
        'LastTitle'			=> 'Defendant Last Name ',
        'ThirdParty'        => 'Select Party ',
        'ActualAmount'		=> 'Case Amount ',
       // 'Document'	        => 'Upload Invoice'
        // 'AgreementDate'	    => 'Select Agreement Date'
        ));


        $this->setValidators(array(
        'Description'            => new sfValidatorString(array('required'=> false)),
        'FirstTitle'             => new sfValidatorString(array('required'=>true,'max_length' => 45), array(
        'required'  =>'This field is required.',
        'max_length'=>'First name cannot be longer than 45 characters.')),
        'LastTitle'              => new sfValidatorString(array('required'=>true,'max_length' => 45), array(
        'required'  =>'This field is required.',
        'max_length'=>'Last name cannot be longer than 45 characters.')),
        'ThirdParty'             => new sfValidatorString(array('required' => true),array('required' => 'This field is required.')),
        'ActualAmount'           => new sfValidatorNumber(array('required' => true),array('required' => 'This field is required.')),
       // 'Document'               => new sfValidatorFile(array('required' => false),array('required' => 'Please provide Invoice'))

        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('cases[%s]');



    }
}
