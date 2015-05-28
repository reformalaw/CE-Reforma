<?php

/**
 * Permissions form base class.
 *
 * @method Permissions getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePermissionsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'                   => new sfWidgetFormInputHidden(),
      'PermissionCategoryId' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PermissionsPermissionCategory'), 'add_empty' => true)),
      'UniqueKey'            => new sfWidgetFormInputText(),
      'Name'                 => new sfWidgetFormInputText(),
      'CreateDateTime'       => new sfWidgetFormDateTime(),
      'UpdateDateTime'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'PermissionCategoryId' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PermissionsPermissionCategory'), 'required' => false)),
      'UniqueKey'            => new sfValidatorString(array('max_length' => 50)),
      'Name'                 => new sfValidatorString(array('max_length' => 50)),
      'CreateDateTime'       => new sfValidatorDateTime(),
      'UpdateDateTime'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('permissions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Permissions';
  }

}