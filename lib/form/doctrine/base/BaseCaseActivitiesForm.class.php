<?php

/**
 * CaseActivities form base class.
 *
 * @method CaseActivities getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCaseActivitiesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'CaseId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CaseActivitiesCases'), 'add_empty' => false)),
      'ActivityType'   => new sfWidgetFormChoice(array('choices' => array('CustomerBillsSubmitted' => 'CustomerBillsSubmitted', '3rdPartyBillsSubmitted' => '3rdPartyBillsSubmitted', '3rdPartyBillsRejected' => '3rdPartyBillsRejected', 'CheckSent' => 'CheckSent', 'PaymentReceived' => 'PaymentReceived'))),
      'Description'    => new sfWidgetFormTextarea(),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'CaseId'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CaseActivitiesCases'))),
      'ActivityType'   => new sfValidatorChoice(array('choices' => array(0 => 'CustomerBillsSubmitted', 1 => '3rdPartyBillsSubmitted', 2 => '3rdPartyBillsRejected', 3 => 'CheckSent', 4 => 'PaymentReceived'))),
      'Description'    => new sfValidatorString(),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('case_activities[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CaseActivities';
  }

}
