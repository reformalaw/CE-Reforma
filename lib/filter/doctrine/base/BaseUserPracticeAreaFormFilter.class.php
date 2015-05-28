<?php

/**
 * UserPracticeArea filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUserPracticeAreaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'UserId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaUsers'), 'add_empty' => true)),
      'PracticeareaId' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaPracticeAreas'), 'add_empty' => true)),
      'CatId'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaCat'), 'add_empty' => true)),
      'SubCatId'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaSubCat'), 'add_empty' => true)),
      'ChildId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaChild'), 'add_empty' => true)),
      'Level'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CreateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'UserId'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserPracticeAreaUsers'), 'column' => 'Id')),
      'PracticeareaId' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserPracticeAreaPracticeAreas'), 'column' => 'Id')),
      'CatId'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserPracticeAreaCat'), 'column' => 'Id')),
      'SubCatId'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserPracticeAreaSubCat'), 'column' => 'Id')),
      'ChildId'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserPracticeAreaChild'), 'column' => 'Id')),
      'Level'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'CreateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('user_practice_area_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserPracticeArea';
  }

  public function getFields()
  {
    return array(
      'Id'             => 'Number',
      'UserId'         => 'ForeignKey',
      'PracticeareaId' => 'ForeignKey',
      'CatId'          => 'ForeignKey',
      'SubCatId'       => 'ForeignKey',
      'ChildId'        => 'ForeignKey',
      'Level'          => 'Number',
      'CreateDateTime' => 'Date',
      'UpdateDateTime' => 'Date',
    );
  }
}
