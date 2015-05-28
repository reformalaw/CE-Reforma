<?php

/**
 * UserProfile form base class.
 *
 * @method UserProfile getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserProfileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'               => new sfWidgetFormInputHidden(),
      'UserId'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserProfileUsers'), 'add_empty' => false)),
      'FirmName'         => new sfWidgetFormInputText(),
      'Address1'         => new sfWidgetFormInputText(),
      'Address2'         => new sfWidgetFormInputText(),
      'City'             => new sfWidgetFormInputText(),
      'StateId'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserProfileStates'), 'add_empty' => false)),
      'Zip'              => new sfWidgetFormInputText(),
      'Phone'            => new sfWidgetFormInputText(),
      'Summary'          => new sfWidgetFormTextarea(),
      'FeesInformation'  => new sfWidgetFormTextarea(),
      'FreeConsultation' => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'CreateDateTime'   => new sfWidgetFormDateTime(),
      'UpdateDateTime'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'UserId'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserProfileUsers'))),
      'FirmName'         => new sfValidatorString(array('max_length' => 100)),
      'Address1'         => new sfValidatorString(array('max_length' => 150)),
      'Address2'         => new sfValidatorString(array('max_length' => 150)),
      'City'             => new sfValidatorString(array('max_length' => 50)),
      'StateId'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserProfileStates'))),
      'Zip'              => new sfValidatorString(array('max_length' => 10)),
      'Phone'            => new sfValidatorString(array('max_length' => 20)),
      'Summary'          => new sfValidatorString(),
      'FeesInformation'  => new sfValidatorString(),
      'FreeConsultation' => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'))),
      'CreateDateTime'   => new sfValidatorDateTime(),
      'UpdateDateTime'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserProfile';
  }

}
