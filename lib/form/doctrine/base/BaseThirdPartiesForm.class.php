<?php

/**
 * ThirdParties form base class.
 *
 * @method ThirdParties getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseThirdPartiesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'Name'           => new sfWidgetFormInputText(),
      'Address1'       => new sfWidgetFormInputText(),
      'Address2'       => new sfWidgetFormInputText(),
      'City'           => new sfWidgetFormInputText(),
      'CountryId'      => new sfWidgetFormInputText(),
      'CountyId'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ThirdPartiesCounties'), 'add_empty' => false)),
      'StateId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ThirdPartiesStates'), 'add_empty' => false)),
      'Zip'            => new sfWidgetFormInputText(),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'Name'           => new sfValidatorString(array('max_length' => 150)),
      'Address1'       => new sfValidatorString(array('max_length' => 150)),
      'Address2'       => new sfValidatorString(array('max_length' => 150)),
      'City'           => new sfValidatorString(array('max_length' => 150)),
      'CountryId'      => new sfValidatorInteger(),
      'CountyId'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ThirdPartiesCounties'))),
      'StateId'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ThirdPartiesStates'))),
      'Zip'            => new sfValidatorString(array('max_length' => 10)),
      'Status'         => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive', 2 => 'Deleted'))),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('third_parties[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ThirdParties';
  }

}
