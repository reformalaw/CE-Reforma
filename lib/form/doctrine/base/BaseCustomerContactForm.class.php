<?php

/**
 * CustomerContact form base class.
 *
 * @method CustomerContact getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCustomerContactForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'UserId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CustomerContactUsers'), 'add_empty' => false)),
      'Label'          => new sfWidgetFormInputText(),
      'FieldType'      => new sfWidgetFormInputText(),
      'Options'        => new sfWidgetFormTextarea(),
      'Required'       => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'Ordering'       => new sfWidgetFormInputText(),
      'OptionsSlug'    => new sfWidgetFormInputText(),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'UserId'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CustomerContactUsers'))),
      'Label'          => new sfValidatorString(array('max_length' => 50)),
      'FieldType'      => new sfValidatorString(array('max_length' => 50)),
      'Options'        => new sfValidatorString(),
      'Required'       => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'))),
      'Ordering'       => new sfValidatorInteger(),
      'OptionsSlug'    => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('customer_contact[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CustomerContact';
  }

}
