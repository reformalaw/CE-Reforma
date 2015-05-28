<?php

/**
 * CustomerPaymentSent form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Chiintan Fadia
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CustomerPaymentSentForm extends BaseCustomerPaymentSentForm
{
    public function configure()
    {
        parent::configure();
        //COMMENT : UNSET THE DATABASE FIELD NOT PROCESS THROUGH FORM
        unset(
        $this['UserId'],
        $this['CaseNo'],
        $this['CaseId'],
        $this['ActualAmount'],
        $this['CommisionPercentage'],
        $this['CommisionActual'],
        $this['ProcessingFees'],
        $this['UnderpayAdjustment'],
        $this['PayableAmount'],
        $this['CustomerPaidDate'],
        $this['CheckNo'],
        $this['Description'],
        $this['UpdateDateTime'],
        $this['CreateDateTime']

        );

        $this->setWidgets(array(
        'PayableAmount'         => new sfWidgetFormInputText(),
        'UnderpayAdjustment'    => new sfWidgetFormInputText(),
        'CheckNo'               => new sfWidgetFormInputText(),
        #'CustomerPaidDate'     => new sfWidgetFormDate(array('can_be_empty'=> false,'default'=>date('m/d/Y'))),
        'CustomerPaidDate'      => new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>sfConfig::get('app_AgreementDate_YearRange'))),
        'Description'           => new sfWidgetFormTextarea(array(),array('rows'=>3,'cols'=>25)),
        ));

        //COMMENT : SET THE DEFAULT LABES FOR Customer

        $this->widgetSchema->setLabels(array(
        'PayableAmount'         => 'Amount',
        'UnderpayAdjustment'    => 'UnderPay Adjustment',
        'CheckNo'               => 'Check No.',
        'CustomerPaidDate'      => 'Select Paid Date',
        'Description'           => 'Memo ',

        ));


        $this->setValidators(array(
        'PayableAmount'         => new sfValidatorNumber(array('required' => true),array('required' => 'Please enter Amount')),
        'UnderpayAdjustment'    => new sfValidatorNumber(array('required' => false),array('required' => 'Please enter UnderPay Adjustment')),
        'CheckNo'               => new sfValidatorString(array('required' => true),array('required' => 'Please Provide Check No')),
        'CustomerPaidDate'      => new sfValidatorDate(array('required' => true),array('required' => 'Please select Paid Date')),
        'Description'           => new sfValidatorString(array('required'=> false)),
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('paymentsent[%s]');

    }
}
