<?php

/**
 * UsersWebsite form base class.
 *
 * @method UsersWebsite getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsersWebsiteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'UserId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsersWebsiteUsers'), 'add_empty' => false)),
      'ThemeId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsersWebsiteTheme'), 'add_empty' => false)),
      'Websiteurl'     => new sfWidgetFormInputText(),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive'))),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'UserId'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsersWebsiteUsers'))),
      'ThemeId'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsersWebsiteTheme'))),
      'Websiteurl'     => new sfValidatorString(array('max_length' => 150)),
      'Status'         => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive'))),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('users_website[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UsersWebsite';
  }

}
