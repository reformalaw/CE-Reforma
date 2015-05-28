<?php

/**
 * ThirdPartyPaymentReceived filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseThirdPartyPaymentReceivedFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ThirdParty'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ThirdPartyPaymentReceivedThirdParties'), 'add_empty' => true)),
      'CaseNo'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ReceivedAmount'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'PaymentReceivedDate' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'DifferenceAmount'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Description'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CreateDateTime'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'ThirdParty'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ThirdPartyPaymentReceivedThirdParties'), 'column' => 'Id')),
      'CaseNo'              => new sfValidatorPass(array('required' => false)),
      'ReceivedAmount'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'PaymentReceivedDate' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'DifferenceAmount'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'Description'         => new sfValidatorPass(array('required' => false)),
      'CreateDateTime'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('third_party_payment_received_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ThirdPartyPaymentReceived';
  }

  public function getFields()
  {
    return array(
      'Id'                  => 'Number',
      'ThirdParty'          => 'ForeignKey',
      'CaseId'              => 'Number',
      'CaseNo'              => 'Text',
      'ReceivedAmount'      => 'Number',
      'PaymentReceivedDate' => 'Date',
      'DifferenceAmount'    => 'Number',
      'Description'         => 'Text',
      'CreateDateTime'      => 'Date',
      'UpdateDateTime'      => 'Date',
    );
  }
}
