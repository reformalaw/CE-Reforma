<?php

/**
 * Permissions filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePermissionsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'PermissionCategoryId' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PermissionsPermissionCategory'), 'add_empty' => true)),
      'UniqueKey'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Name'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CreateDateTime'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'PermissionCategoryId' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PermissionsPermissionCategory'), 'column' => 'Id')),
      'UniqueKey'            => new sfValidatorPass(array('required' => false)),
      'Name'                 => new sfValidatorPass(array('required' => false)),
      'CreateDateTime'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('permissions_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Permissions';
  }

  public function getFields()
  {
    return array(
      'Id'                   => 'Number',
      'PermissionCategoryId' => 'ForeignKey',
      'UniqueKey'            => 'Text',
      'Name'                 => 'Text',
      'CreateDateTime'       => 'Date',
      'UpdateDateTime'       => 'Date',
    );
  }
}
