<?php

/**
 * ForumTopics filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseForumTopicsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'UserId'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ForumTopicsUsers'), 'add_empty' => true)),
      'ForumId'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ForumTopicsForums'), 'add_empty' => true)),
      'LastRepliedId'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'LastRepliedBy'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'TotalViews'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Topic'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Description'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'TotalReplies'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Status'              => new sfWidgetFormChoice(array('choices' => array('' => '', 'Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'LastRepliedDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'CreateDateTime'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'UserId'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ForumTopicsUsers'), 'column' => 'Id')),
      'ForumId'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ForumTopicsForums'), 'column' => 'Id')),
      'LastRepliedId'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'LastRepliedBy'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'TotalViews'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'Topic'               => new sfValidatorPass(array('required' => false)),
      'Description'         => new sfValidatorPass(array('required' => false)),
      'TotalReplies'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'Status'              => new sfValidatorChoice(array('required' => false, 'choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'LastRepliedDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'CreateDateTime'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('forum_topics_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ForumTopics';
  }

  public function getFields()
  {
    return array(
      'Id'                  => 'Number',
      'UserId'              => 'ForeignKey',
      'ForumId'             => 'ForeignKey',
      'LastRepliedId'       => 'Number',
      'LastRepliedBy'       => 'Number',
      'TotalViews'          => 'Number',
      'Topic'               => 'Text',
      'Description'         => 'Text',
      'TotalReplies'        => 'Number',
      'Status'              => 'Enum',
      'LastRepliedDateTime' => 'Date',
      'CreateDateTime'      => 'Date',
      'UpdateDateTime'      => 'Date',
    );
  }
}
