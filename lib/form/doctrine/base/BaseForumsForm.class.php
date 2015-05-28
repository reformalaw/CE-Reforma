<?php

/**
 * Forums form base class.
 *
 * @method Forums getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseForumsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'                => new sfWidgetFormInputHidden(),
      'ForumCategoriesId' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ForumsForumCategories'), 'add_empty' => false)),
      'LastTopicId'       => new sfWidgetFormInputText(),
      'LastTopicBy'       => new sfWidgetFormInputText(),
      'LastRepliedId'     => new sfWidgetFormInputText(),
      'LastRepliedBy'     => new sfWidgetFormInputText(),
      'Title'             => new sfWidgetFormTextarea(),
      'Description'       => new sfWidgetFormTextarea(),
      'TotalTopic'        => new sfWidgetFormInputText(),
      'TotalReplies'      => new sfWidgetFormInputText(),
      'Ordering'          => new sfWidgetFormInputText(),
      'Status'            => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Delete' => 'Delete'))),
      'CreateDateTime'    => new sfWidgetFormDateTime(),
      'UpdateDateTime'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'ForumCategoriesId' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ForumsForumCategories'))),
      'LastTopicId'       => new sfValidatorInteger(),
      'LastTopicBy'       => new sfValidatorInteger(),
      'LastRepliedId'     => new sfValidatorInteger(),
      'LastRepliedBy'     => new sfValidatorInteger(),
      'Title'             => new sfValidatorString(),
      'Description'       => new sfValidatorString(),
      'TotalTopic'        => new sfValidatorInteger(),
      'TotalReplies'      => new sfValidatorInteger(),
      'Ordering'          => new sfValidatorInteger(),
      'Status'            => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive', 2 => 'Delete'))),
      'CreateDateTime'    => new sfValidatorDateTime(),
      'UpdateDateTime'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('forums[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Forums';
  }

}
