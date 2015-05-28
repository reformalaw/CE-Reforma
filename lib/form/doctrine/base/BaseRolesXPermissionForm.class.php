<?php

/**
 * RolesXPermission form base class.
 *
 * @method RolesXPermission getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRolesXPermissionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'                   => new sfWidgetFormInputHidden(),
      'RoleId'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RolesXPermissionRoles'), 'add_empty' => false)),
      'PermissionId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RolesXPermissionPermissions'), 'add_empty' => false)),
      'PermissionCategoryId' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RolesXPermissionPermissionCategory'), 'add_empty' => true)),
      'CreateDateTime'       => new sfWidgetFormDateTime(),
      'UpdateDateTime'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'RoleId'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RolesXPermissionRoles'))),
      'PermissionId'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RolesXPermissionPermissions'))),
      'PermissionCategoryId' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RolesXPermissionPermissionCategory'), 'required' => false)),
      'CreateDateTime'       => new sfValidatorDateTime(),
      'UpdateDateTime'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('roles_x_permission[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RolesXPermission';
  }

}
