<?php

/**
 * UserPracticeArea form base class.
 *
 * @method UserPracticeArea getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserPracticeAreaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'UserId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaUsers'), 'add_empty' => false)),
      'PracticeareaId' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaPracticeAreas'), 'add_empty' => false)),
      'CatId'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaCat'), 'add_empty' => false)),
      'SubCatId'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaSubCat'), 'add_empty' => false)),
      'ChildId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaChild'), 'add_empty' => false)),
      'Level'          => new sfWidgetFormInputText(),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'UserId'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaUsers'))),
      'PracticeareaId' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaPracticeAreas'))),
      'CatId'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaCat'))),
      'SubCatId'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaSubCat'))),
      'ChildId'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserPracticeAreaChild'))),
      'Level'          => new sfValidatorInteger(),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('user_practice_area[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserPracticeArea';
  }

}
