<?php

/**
 * FAQs form base class.
 *
 * @method FAQs getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFAQsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'Question'       => new sfWidgetFormTextarea(),
      'Answer'         => new sfWidgetFormTextarea(),
      'Globle'         => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive'))),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'Question'       => new sfValidatorString(),
      'Answer'         => new sfValidatorString(),
      'Globle'         => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'))),
      'Status'         => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive'))),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('fa_qs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FAQs';
  }

}
