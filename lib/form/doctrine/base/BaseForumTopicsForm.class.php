<?php

/**
 * ForumTopics form base class.
 *
 * @method ForumTopics getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseForumTopicsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'                  => new sfWidgetFormInputHidden(),
      'UserId'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ForumTopicsUsers'), 'add_empty' => false)),
      'ForumId'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ForumTopicsForums'), 'add_empty' => false)),
      'LastRepliedId'       => new sfWidgetFormInputText(),
      'LastRepliedBy'       => new sfWidgetFormInputText(),
      'TotalViews'          => new sfWidgetFormInputText(),
      'Topic'               => new sfWidgetFormTextarea(),
      'Description'         => new sfWidgetFormTextarea(),
      'TotalReplies'        => new sfWidgetFormInputText(),
      'Status'              => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'LastRepliedDateTime' => new sfWidgetFormDateTime(),
      'CreateDateTime'      => new sfWidgetFormDateTime(),
      'UpdateDateTime'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'UserId'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ForumTopicsUsers'))),
      'ForumId'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ForumTopicsForums'))),
      'LastRepliedId'       => new sfValidatorInteger(),
      'LastRepliedBy'       => new sfValidatorInteger(),
      'TotalViews'          => new sfValidatorInteger(),
      'Topic'               => new sfValidatorString(),
      'Description'         => new sfValidatorString(),
      'TotalReplies'        => new sfValidatorInteger(),
      'Status'              => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive', 2 => 'Deleted'))),
      'LastRepliedDateTime' => new sfValidatorDateTime(array('required' => false)),
      'CreateDateTime'      => new sfValidatorDateTime(),
      'UpdateDateTime'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('forum_topics[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ForumTopics';
  }

}
