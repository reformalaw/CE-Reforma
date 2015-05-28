<?php

/**
 * ThirdPartyPaymentReceived form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ThirdPartyPaymentReceivedForm extends BaseThirdPartyPaymentReceivedForm
{
    public function configure()
    {

        parent::configure();
        //COMMENT : UNSET THE DATABASE FIELD NOT PROCESS THROUGH FORM
        unset(
        $this['ThirdParty'],
        $this['CaseId'],
        $this['CaseNo'],
        $this['ReceivedAmount'],
        $this['PaymentReceivedDate'],
        $this['DifferenceAmount'],
        $this['Description'],
        $this['UpdateDateTime'],
        $this['CreateDateTime']

        );

        $this->setWidgets(array(
        'ReceivedAmount'         => new sfWidgetFormInputText(),
        #'PaymentReceivedDate'   => new sfWidgetFormDate(array('can_be_empty'=> false,'default'=>date('m/d/Y'))),
        'PaymentReceivedDate'    => new sfWidgetFormDateJQueryUI(array("change_month" => true,"change_year" => true,'yearRange'=>sfConfig::get('app_AgreementDate_YearRange'))),
        'Description'            => new sfWidgetFormTextarea(array(),array('rows'=>3,'cols'=>25)),
        ));

        //COMMENT : SET THE DEFAULT LABES FOR Customer

        $this->widgetSchema->setLabels(array(
        'ReceivedAmount'         => 'Payments Disbursed',
        'PaymentReceivedDate'    => 'Payments Disbursed Date',
        'Description'            => 'Memo'
        ));


        $this->setValidators(array(
        'ReceivedAmount'         => new sfValidatorNumber(array('required' => true),array('required' => 'Please enter Payments Disbursed')),
        'PaymentReceivedDate'    => new sfValidatorDate(array('required' => true),array('required' => 'Please select Payments Disbursed Date')),
        'Description'            => new sfValidatorString(array('required'=> false))
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('paymentrecd[%s]');

    }
}
