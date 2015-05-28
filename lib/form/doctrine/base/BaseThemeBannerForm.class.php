<?php

/**
 * ThemeBanner form base class.
 *
 * @method ThemeBanner getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseThemeBannerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'ThemeId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ThemeBannerTheme'), 'add_empty' => false)),
      'WebsiteId'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ThemeBannerUserWebsite'), 'add_empty' => false)),
      'BannerName'     => new sfWidgetFormInputText(),
      'Image'          => new sfWidgetFormInputText(),
      'Title1'         => new sfWidgetFormInputText(),
      'Title2'         => new sfWidgetFormInputText(),
      'Title3'         => new sfWidgetFormInputText(),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive'))),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'ThemeId'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ThemeBannerTheme'))),
      'WebsiteId'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ThemeBannerUserWebsite'))),
      'BannerName'     => new sfValidatorString(array('max_length' => 150)),
      'Image'          => new sfValidatorString(array('max_length' => 150)),
      'Title1'         => new sfValidatorString(array('max_length' => 150)),
      'Title2'         => new sfValidatorString(array('max_length' => 150)),
      'Title3'         => new sfValidatorString(array('max_length' => 150)),
      'Status'         => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive'))),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('theme_banner[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ThemeBanner';
  }

}
