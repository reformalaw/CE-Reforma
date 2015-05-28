<?php

/**
 * PracticeAreas form base class.
 *
 * @method PracticeAreas getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePracticeAreasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'Name'           => new sfWidgetFormInputText(),
      'ParentId'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PracticeAreasParents'), 'add_empty' => false)),
      'Description'    => new sfWidgetFormInputText(),
      'slug'           => new sfWidgetFormInputText(),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'Name'           => new sfValidatorString(array('max_length' => 50)),
      'ParentId'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PracticeAreasParents'))),
      'Description'    => new sfValidatorPass(),
      'slug'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'Status'         => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive', 2 => 'Deleted'))),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'PracticeAreas', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('practice_areas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PracticeAreas';
  }

}
