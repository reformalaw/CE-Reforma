<?php

/**
 * UserPracticeAreaLocation form base class.
 *
 * @method UserPracticeAreaLocation getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserPracticeAreaLocationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'UserId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaLocationUsers'), 'add_empty' => false)),
      'StateId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaLocationState'), 'add_empty' => false)),
      'CountyId'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaLocationCounties'), 'add_empty' => false)),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'UserId'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaLocationUsers'))),
      'StateId'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaLocationState'))),
      'CountyId'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaLocationCounties'))),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('user_practice_area_location[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserPracticeAreaLocation';
  }

}
