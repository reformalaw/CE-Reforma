<?php

/**
 * Forums filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseForumsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ForumCategoriesId' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ForumsForumCategories'), 'add_empty' => true)),
      'LastTopicId'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'LastTopicBy'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'LastRepliedId'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'LastRepliedBy'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Title'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Description'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'TotalTopic'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'TotalReplies'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Ordering'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Status'            => new sfWidgetFormChoice(array('choices' => array('' => '', 'Active' => 'Active', 'Inactive' => 'Inactive', 'Delete' => 'Delete'))),
      'CreateDateTime'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'ForumCategoriesId' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ForumsForumCategories'), 'column' => 'Id')),
      'LastTopicId'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'LastTopicBy'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'LastRepliedId'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'LastRepliedBy'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'Title'             => new sfValidatorPass(array('required' => false)),
      'Description'       => new sfValidatorPass(array('required' => false)),
      'TotalTopic'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'TotalReplies'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'Ordering'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'Status'            => new sfValidatorChoice(array('required' => false, 'choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Delete' => 'Delete'))),
      'CreateDateTime'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('forums_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Forums';
  }

  public function getFields()
  {
    return array(
      'Id'                => 'Number',
      'ForumCategoriesId' => 'ForeignKey',
      'LastTopicId'       => 'Number',
      'LastTopicBy'       => 'Number',
      'LastRepliedId'     => 'Number',
      'LastRepliedBy'     => 'Number',
      'Title'             => 'Text',
      'Description'       => 'Text',
      'TotalTopic'        => 'Number',
      'TotalReplies'      => 'Number',
      'Ordering'          => 'Number',
      'Status'            => 'Enum',
      'CreateDateTime'    => 'Date',
      'UpdateDateTime'    => 'Date',
    );
  }
}
