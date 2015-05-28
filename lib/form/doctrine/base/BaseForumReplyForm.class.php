<?php

/**
 * ForumReply form base class.
 *
 * @method ForumReply getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseForumReplyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'ForumId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ForumReplyForums'), 'add_empty' => false)),
      'TopicId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ForumReplyForumTopics'), 'add_empty' => false)),
      'UserId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ForumReplyUsers'), 'add_empty' => false)),
      'Reply'          => new sfWidgetFormTextarea(),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'ForumId'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ForumReplyForums'))),
      'TopicId'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ForumReplyForumTopics'))),
      'UserId'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ForumReplyUsers'))),
      'Reply'          => new sfValidatorString(),
      'Status'         => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive', 2 => 'Deleted'))),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('forum_reply[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ForumReply';
  }

}
