<?php

/**
 * ThemeOptions form base class.
 *
 * @method ThemeOptions getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseThemeOptionsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'ThemeId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ThemeOptionsTheme'), 'add_empty' => false)),
      'WebsiteId'      => new sfWidgetFormInputText(),
      'OptionKey'      => new sfWidgetFormInputText(),
      'OptionValue'    => new sfWidgetFormTextarea(),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'ThemeId'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ThemeOptionsTheme'))),
      'WebsiteId'      => new sfValidatorInteger(),
      'OptionKey'      => new sfValidatorString(array('max_length' => 150)),
      'OptionValue'    => new sfValidatorString(),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('theme_options[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ThemeOptions';
  }

}
