<?php

/**
 * CustomerPaymentSent form base class.
 *
 * @method CustomerPaymentSent getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCustomerPaymentSentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'                  => new sfWidgetFormInputHidden(),
      'UserId'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CustomerPaymentSentUsers'), 'add_empty' => false)),
      'CaseNo'              => new sfWidgetFormInputText(),
      'CaseId'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CustomerPaymentSentCases'), 'add_empty' => true)),
      'ActualAmount'        => new sfWidgetFormInputText(),
      'CommisionPercentage' => new sfWidgetFormInputText(),
      'CommisionActual'     => new sfWidgetFormInputText(),
      'ProcessingFees'      => new sfWidgetFormInputText(),
      'UnderpayAdjustment'  => new sfWidgetFormInputText(),
      'PayableAmount'       => new sfWidgetFormInputText(),
      'CustomerPaidDate'    => new sfWidgetFormDateTime(),
      'CheckNo'             => new sfWidgetFormInputText(),
      'Description'         => new sfWidgetFormTextarea(),
      'CreateDateTime'      => new sfWidgetFormDateTime(),
      'UpdateDateTime'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'UserId'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CustomerPaymentSentUsers'))),
      'CaseNo'              => new sfValidatorString(array('max_length' => 15)),
      'CaseId'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CustomerPaymentSentCases'), 'required' => false)),
      'ActualAmount'        => new sfValidatorNumber(),
      'CommisionPercentage' => new sfValidatorNumber(),
      'CommisionActual'     => new sfValidatorNumber(),
      'ProcessingFees'      => new sfValidatorNumber(),
      'UnderpayAdjustment'  => new sfValidatorNumber(),
      'PayableAmount'       => new sfValidatorNumber(),
      'CustomerPaidDate'    => new sfValidatorDateTime(array('required' => false)),
      'CheckNo'             => new sfValidatorString(array('max_length' => 50)),
      'Description'         => new sfValidatorString(),
      'CreateDateTime'      => new sfValidatorDateTime(),
      'UpdateDateTime'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('customer_payment_sent[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CustomerPaymentSent';
  }

}
