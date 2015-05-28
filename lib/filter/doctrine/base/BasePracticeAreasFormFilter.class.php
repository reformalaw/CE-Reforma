<?php

/**
 * PracticeAreas filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePracticeAreasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Name'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ParentId'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PracticeAreasParents'), 'add_empty' => true)),
      'Description'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slug'           => new sfWidgetFormFilterInput(),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'CreateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'Name'           => new sfValidatorPass(array('required' => false)),
      'ParentId'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PracticeAreasParents'), 'column' => 'Id')),
      'Description'    => new sfValidatorPass(array('required' => false)),
      'slug'           => new sfValidatorPass(array('required' => false)),
      'Status'         => new sfValidatorChoice(array('required' => false, 'choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'CreateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('practice_areas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PracticeAreas';
  }

  public function getFields()
  {
    return array(
      'Id'             => 'Number',
      'Name'           => 'Text',
      'ParentId'       => 'ForeignKey',
      'Description'    => 'Text',
      'slug'           => 'Text',
      'Status'         => 'Enum',
      'CreateDateTime' => 'Date',
      'UpdateDateTime' => 'Date',
    );
  }
}
