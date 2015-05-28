<?php

/**
 * Theme form base class.
 *
 * @method Theme getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseThemeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'                       => new sfWidgetFormInputHidden(),
      'Name'                     => new sfWidgetFormInputText(),
      'UniqueName'               => new sfWidgetFormInputText(),
      'ScreenShot'               => new sfWidgetFormInputText(),
      'Status'                   => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'IsDefault'                => new sfWidgetFormChoice(array('choices' => array('YES' => 'YES', 'NO' => 'NO'))),
      'Features'                 => new sfWidgetFormTextarea(),
      'Options'                  => new sfWidgetFormTextarea(),
      'ManageTopMenu'            => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'ManageFooterMenu'         => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'ManageBanner'             => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'ManageColorAndBackground' => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'ManageSocialMedia'        => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'ChangeLogo'               => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'ManageFAQs'               => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'TextWidgets'              => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'BodyBackground'           => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'CreateDateTime'           => new sfWidgetFormDateTime(),
      'UpdateDateTime'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'Name'                     => new sfValidatorString(array('max_length' => 150)),
      'UniqueName'               => new sfValidatorString(array('max_length' => 150)),
      'ScreenShot'               => new sfValidatorString(array('max_length' => 150)),
      'Status'                   => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive', 2 => 'Deleted'))),
      'IsDefault'                => new sfValidatorChoice(array('choices' => array(0 => 'YES', 1 => 'NO'))),
      'Features'                 => new sfValidatorString(),
      'Options'                  => new sfValidatorString(),
      'ManageTopMenu'            => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'), 'required' => false)),
      'ManageFooterMenu'         => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'), 'required' => false)),
      'ManageBanner'             => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'), 'required' => false)),
      'ManageColorAndBackground' => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'), 'required' => false)),
      'ManageSocialMedia'        => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'), 'required' => false)),
      'ChangeLogo'               => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'), 'required' => false)),
      'ManageFAQs'               => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'), 'required' => false)),
      'TextWidgets'              => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'), 'required' => false)),
      'BodyBackground'           => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'), 'required' => false)),
      'CreateDateTime'           => new sfValidatorDateTime(),
      'UpdateDateTime'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('theme[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Theme';
  }

}
