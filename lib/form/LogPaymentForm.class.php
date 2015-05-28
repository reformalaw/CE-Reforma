<?php

/**
 * Cases form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LogPaymentForm extends BaseCasesForm
{
    public function configure()
    {
        parent::configure();

        //COMMENT : UNSET THE DATABASE FIELD NOT PROCESS THROUGH FORM
        unset(
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
        //$this['CustomerPaidDate'],
        $this['PaymentReceivedDate'],
        $this['Stage'],
        $this['Status'],
        $this['CreatedBy'],
        $this['UpdateDateTime'],
        $this['CreateDateTime']

        );

        //FOR ASCENDING ORDER USERS
        $customerQueryObject = Doctrine::getTable("Users")->getCustomers();
        #clsCommon::pr($customerQueryObject);


        $this->setWidgets(array(
        'UserId'  => new sfWidgetFormChoice(array('choices' =>  array( '' => 'Select') + $customerQueryObject),array('style'=>'width:250px;')),
        'CaseNo'  => new sfWidgetFormChoice(array('choices' =>  array( '' => 'Select')),array('style'=>'width:250px;')),
        'CheckNo' => new sfWidgetFormInputText(array(),array('style'=>'width:245px;')),
        'CustomerPaidDate'   => new sfWidgetFormDate(array('can_be_empty'=> false,'default'=>date('m/d/Y')))
        ));

        //COMMENT : SET THE DEFAULT LABES FOR Customer

        $this->widgetSchema->setLabels(array(
        'UserId'	=> 'Select Customer',
        'CaseNo'	=> 'Select Case No. & Title',
        'CheckNo'	=> 'Check Num',
        'CustomerPaidDate'  => 'Select Paid Date',
        ));


        $this->setValidators(array(
        'UserId'    => new sfValidatorString(array('required' => true),array('required' => 'Please select Customer')),
        'CaseNo'    => new sfValidatorString(array('required' => true),array('required' => 'Please select Case No & Title')),
        'CheckNo'   => new sfValidatorString(array('required' => true),array('required' => 'Please Provide Check No')),
        'CustomerPaidDate'   => new sfValidatorDate(array('required' => true),array('required' => 'Please select Paid Date'))      

        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('log[%s]');



    }
}
