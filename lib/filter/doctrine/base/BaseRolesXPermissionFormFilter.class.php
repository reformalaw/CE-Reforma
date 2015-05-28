<?php

/**
 * RolesXPermission filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRolesXPermissionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'RoleId'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RolesXPermissionRoles'), 'add_empty' => true)),
      'PermissionId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RolesXPermissionPermissions'), 'add_empty' => true)),
      'PermissionCategoryId' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RolesXPermissionPermissionCategory'), 'add_empty' => true)),
      'CreateDateTime'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'RoleId'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RolesXPermissionRoles'), 'column' => 'Id')),
      'PermissionId'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RolesXPermissionPermissions'), 'column' => 'Id')),
      'PermissionCategoryId' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RolesXPermissionPermissionCategory'), 'column' => 'Id')),
      'CreateDateTime'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('roles_x_permission_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RolesXPermission';
  }

  public function getFields()
  {
    return array(
      'Id'                   => 'Number',
      'RoleId'               => 'ForeignKey',
      'PermissionId'         => 'ForeignKey',
      'PermissionCategoryId' => 'ForeignKey',
      'CreateDateTime'       => 'Date',
      'UpdateDateTime'       => 'Date',
    );
  }
}
