<?php

/**
 * ForumReply filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseForumReplyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ForumId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ForumReplyForums'), 'add_empty' => true)),
      'TopicId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ForumReplyForumTopics'), 'add_empty' => true)),
      'UserId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ForumReplyUsers'), 'add_empty' => true)),
      'Reply'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'CreateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'ForumId'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ForumReplyForums'), 'column' => 'Id')),
      'TopicId'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ForumReplyForumTopics'), 'column' => 'Id')),
      'UserId'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ForumReplyUsers'), 'column' => 'Id')),
      'Reply'          => new sfValidatorPass(array('required' => false)),
      'Status'         => new sfValidatorChoice(array('required' => false, 'choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'CreateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('forum_reply_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ForumReply';
  }

  public function getFields()
  {
    return array(
      'Id'             => 'Number',
      'ForumId'        => 'ForeignKey',
      'TopicId'        => 'ForeignKey',
      'UserId'         => 'ForeignKey',
      'Reply'          => 'Text',
      'Status'         => 'Enum',
      'CreateDateTime' => 'Date',
      'UpdateDateTime' => 'Date',
    );
  }
}
