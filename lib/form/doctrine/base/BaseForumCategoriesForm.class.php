<?php

/**
 * ForumCategories form base class.
 *
 * @method ForumCategories getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseForumCategoriesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'Title'          => new sfWidgetFormInputText(),
      'Description'    => new sfWidgetFormTextarea(),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Delete' => 'Delete'))),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'Title'          => new sfValidatorString(array('max_length' => 150)),
      'Description'    => new sfValidatorString(),
      'Status'         => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive', 2 => 'Delete'))),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('forum_categories[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ForumCategories';
  }

}
