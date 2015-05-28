<?php

/**
 * Cases form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LogReceivedPaymentForm extends BaseCasesForm
{
    public function configure()
    {
        parent::configure();

        //COMMENT : UNSET THE DATABASE FIELD NOT PROCESS THROUGH FORM
        unset(
        $this['UserId'],
        $this['CaseNo'],
        $this['Description'],
        $this['FirstTitle'],
        $this['LastTitle'],
        $this['ThirdParty'],
        $this['BillDocumentRealName'],
        $this['BillDocumentSystemName'],
        $this['ActualAmount'],

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
        $this['CreatedBy'],
        $this['UpdateDateTime'],
        $this['CreateDateTime']

        );

        //FOR ASCENDING ORDER Third PArty
        $tpQueryObject = Doctrine::getTable("ThirdParties")->getThirdParties();
        #clsCommon::pr($tpQueryObject);

        $this->setWidgets(array(
        # 'UserId'  => new sfWidgetFormChoice(array('choices' =>  array( '' => 'Select') + $customerQueryObject),array('style'=>'width:250px;')),
        'ThirdParty'            => new sfWidgetFormChoice(array('choices' =>  array( '' => 'Select') + $tpQueryObject),array('style'=>'width:250px;')),
        'CaseNo'                => new sfWidgetFormChoice(array('choices' =>  array( '' => 'Select')),array('style'=>'width:250px;')),
        'ReceivedAmount'        => new sfWidgetFormInputText(array(),array('style'=>'width:250px;')),
        'PaymentReceivedDate'   => new sfWidgetFormDate(array('can_be_empty'=> false,'default'=>date('m/d/Y'))),
        
        
        ));

        //COMMENT : SET THE DEFAULT LABELS

        $this->widgetSchema->setLabels(array(
        'ThirdParty'	       => 'Select 3rd Party',
        'CaseNo'	           => 'Select Case No. & Title',
        'ReceivedAmount'       => 'Amount Received',
        'PaymentReceivedDate'  => 'Amount Received Date',
        ));


        $this->setValidators(array(
        'ThirdParty'            => new sfValidatorString(array('required' => true),array('required' => 'Please select 3rd Party')),
        'CaseNo'                => new sfValidatorString(array('required' => true),array('required' => 'Please select Case No & Title')),
        'ReceivedAmount'        => new sfValidatorNumber(array('required' => true),array('required' => 'Please enter Received Amount')),
        'PaymentReceivedDate'   => new sfValidatorDate(array('required' => true),array('required' => 'Please select Payment Received Date'))      

        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('logReceived[%s]');



    }
}
