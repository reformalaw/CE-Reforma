<?php

/**
 * UserPracticeAreaLocation filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUserPracticeAreaLocationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'UserId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaLocationUsers'), 'add_empty' => true)),
      'StateId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaLocationState'), 'add_empty' => true)),
      'CountyId'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaLocationCounties'), 'add_empty' => true)),
      'CreateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'UserId'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserPracticeAreaLocationUsers'), 'column' => 'Id')),
      'StateId'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserPracticeAreaLocationState'), 'column' => 'Id')),
      'CountyId'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserPracticeAreaLocationCounties'), 'column' => 'Id')),
      'CreateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('user_practice_area_location_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserPracticeAreaLocation';
  }

  public function getFields()
  {
    return array(
      'Id'             => 'Number',
      'UserId'         => 'ForeignKey',
      'StateId'        => 'ForeignKey',
      'CountyId'       => 'ForeignKey',
      'CreateDateTime' => 'Date',
      'UpdateDateTime' => 'Date',
    );
  }
}
