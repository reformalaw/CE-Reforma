<?php

/**
 * CustomerPaymentSent filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCustomerPaymentSentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'UserId'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CustomerPaymentSentUsers'), 'add_empty' => true)),
      'CaseNo'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CaseId'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CustomerPaymentSentCases'), 'add_empty' => true)),
      'ActualAmount'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CommisionPercentage' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CommisionActual'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ProcessingFees'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'UnderpayAdjustment'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'PayableAmount'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CustomerPaidDate'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'CheckNo'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Description'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CreateDateTime'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'UserId'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CustomerPaymentSentUsers'), 'column' => 'Id')),
      'CaseNo'              => new sfValidatorPass(array('required' => false)),
      'CaseId'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CustomerPaymentSentCases'), 'column' => 'Id')),
      'ActualAmount'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'CommisionPercentage' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'CommisionActual'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'ProcessingFees'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'UnderpayAdjustment'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'PayableAmount'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'CustomerPaidDate'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'CheckNo'             => new sfValidatorPass(array('required' => false)),
      'Description'         => new sfValidatorPass(array('required' => false)),
      'CreateDateTime'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('customer_payment_sent_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CustomerPaymentSent';
  }

  public function getFields()
  {
    return array(
      'Id'                  => 'Number',
      'UserId'              => 'ForeignKey',
      'CaseNo'              => 'Text',
      'CaseId'              => 'ForeignKey',
      'ActualAmount'        => 'Number',
      'CommisionPercentage' => 'Number',
      'CommisionActual'     => 'Number',
      'ProcessingFees'      => 'Number',
      'UnderpayAdjustment'  => 'Number',
      'PayableAmount'       => 'Number',
      'CustomerPaidDate'    => 'Date',
      'CheckNo'             => 'Text',
      'Description'         => 'Text',
      'CreateDateTime'      => 'Date',
      'UpdateDateTime'      => 'Date',
    );
  }
}
