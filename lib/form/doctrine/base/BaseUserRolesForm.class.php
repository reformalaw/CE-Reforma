<?php

/**
 * UserRoles form base class.
 *
 * @method UserRoles getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserRolesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'UserId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserRolesUsers'), 'add_empty' => false)),
      'RoleId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserRolesRoles'), 'add_empty' => false)),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'UserId'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserRolesUsers'))),
      'RoleId'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserRolesRoles'))),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('user_roles[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserRoles';
  }

}
