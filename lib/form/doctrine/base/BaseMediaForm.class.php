<?php

/**
 * Media form base class.
 *
 * @method Media getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMediaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'Title'          => new sfWidgetFormInputText(),
      'ImageName'      => new sfWidgetFormInputText(),
      'OrgName'        => new sfWidgetFormInputText(),
      'Type'           => new sfWidgetFormChoice(array('choices' => array('BannerBackground' => 'BannerBackground', 'BannerForeground' => 'BannerForeground', 'Unsorted' => 'Unsorted', 'Logo' => 'Logo'))),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'Title'          => new sfValidatorString(array('max_length' => 150)),
      'ImageName'      => new sfValidatorString(array('max_length' => 150)),
      'OrgName'        => new sfValidatorString(array('max_length' => 150)),
      'Type'           => new sfValidatorChoice(array('choices' => array(0 => 'BannerBackground', 1 => 'BannerForeground', 2 => 'Unsorted', 3 => 'Logo'))),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('media[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Media';
  }

}
