<?php

/**
 * WebsiteXFAQs form base class.
 *
 * @method WebsiteXFAQs getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWebsiteXFAQsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'FAQId'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteXFAQsFAQs'), 'add_empty' => false)),
      'WebsiteId'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteXFAQsUsersWebsite'), 'add_empty' => false)),
      'Ordering'       => new sfWidgetFormInputText(),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive'))),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'FAQId'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteXFAQsFAQs'))),
      'WebsiteId'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteXFAQsUsersWebsite'))),
      'Ordering'       => new sfValidatorInteger(),
      'Status'         => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive'))),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('website_xfa_qs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WebsiteXFAQs';
  }

}
