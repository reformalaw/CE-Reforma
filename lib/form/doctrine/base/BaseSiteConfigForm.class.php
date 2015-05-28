<?php

/**
 * SiteConfig form base class.
 *
 * @method SiteConfig getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSiteConfigForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ConfigKey'      => new sfWidgetFormInputHidden(),
      'ConfigValue'    => new sfWidgetFormTextarea(),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ConfigKey'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('ConfigKey')), 'empty_value' => $this->getObject()->get('ConfigKey'), 'required' => false)),
      'ConfigValue'    => new sfValidatorString(),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('site_config[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SiteConfig';
  }

}
