<?php

/**
 * AttorneyStatistics filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAttorneyStatisticsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'UserId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AttorneyStatisticsUsers'), 'add_empty' => true)),
      'IpAddress'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'VisitDate'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'Type'           => new sfWidgetFormChoice(array('choices' => array('' => '', 'Profile' => 'Profile', 'Contact' => 'Contact'))),
      'CreateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'UserId'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AttorneyStatisticsUsers'), 'column' => 'Id')),
      'IpAddress'      => new sfValidatorPass(array('required' => false)),
      'VisitDate'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'Type'           => new sfValidatorChoice(array('required' => false, 'choices' => array('Profile' => 'Profile', 'Contact' => 'Contact'))),
      'CreateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('attorney_statistics_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AttorneyStatistics';
  }

  public function getFields()
  {
    return array(
      'Id'             => 'Number',
      'UserId'         => 'ForeignKey',
      'IpAddress'      => 'Text',
      'VisitDate'      => 'Date',
      'Type'           => 'Enum',
      'CreateDateTime' => 'Date',
      'UpdateDateTime' => 'Date',
    );
  }
}
