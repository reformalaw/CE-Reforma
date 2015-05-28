<?php

/**
 * ThirdPartyPaymentReceived form base class.
 *
 * @method ThirdPartyPaymentReceived getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseThirdPartyPaymentReceivedForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'                  => new sfWidgetFormInputHidden(),
      'ThirdParty'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ThirdPartyPaymentReceivedThirdParties'), 'add_empty' => false)),
      'CaseId'              => new sfWidgetFormInputHidden(),
      'CaseNo'              => new sfWidgetFormInputText(),
      'ReceivedAmount'      => new sfWidgetFormInputText(),
      'PaymentReceivedDate' => new sfWidgetFormDateTime(),
      'DifferenceAmount'    => new sfWidgetFormInputText(),
      'Description'         => new sfWidgetFormTextarea(),
      'CreateDateTime'      => new sfWidgetFormDateTime(),
      'UpdateDateTime'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'ThirdParty'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ThirdPartyPaymentReceivedThirdParties'))),
      'CaseId'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('CaseId')), 'empty_value' => $this->getObject()->get('CaseId'), 'required' => false)),
      'CaseNo'              => new sfValidatorString(array('max_length' => 15)),
      'ReceivedAmount'      => new sfValidatorNumber(),
      'PaymentReceivedDate' => new sfValidatorDateTime(array('required' => false)),
      'DifferenceAmount'    => new sfValidatorNumber(),
      'Description'         => new sfValidatorString(),
      'CreateDateTime'      => new sfValidatorDateTime(),
      'UpdateDateTime'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('third_party_payment_received[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ThirdPartyPaymentReceived';
  }

}
