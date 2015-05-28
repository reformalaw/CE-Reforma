<?php

/**
 * WebsiteMenu form base class.
 *
 * @method WebsiteMenu getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWebsiteMenuForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'                    => new sfWidgetFormInputHidden(),
      'WebsiteId'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteMenuUsersWebsite'), 'add_empty' => true)),
      'CmsPageId'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteMenuCMSPages'), 'add_empty' => true)),
      'WebsitePracticeAreaId' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteMenuWebsitePracticeArea'), 'add_empty' => true)),
      'ParentId'              => new sfWidgetFormInputText(),
      'Title'                 => new sfWidgetFormInputText(),
      'Type'                  => new sfWidgetFormChoice(array('choices' => array(1 => 1, 2 => 2, 3 => 3))),
      'MenuType'              => new sfWidgetFormChoice(array('choices' => array('Header' => 'Header', 'Footer' => 'Footer'))),
      'Ordering'              => new sfWidgetFormInputText(),
      'CreateDateTime'        => new sfWidgetFormDateTime(),
      'UpdateDateTime'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'WebsiteId'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteMenuUsersWebsite'), 'required' => false)),
      'CmsPageId'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteMenuCMSPages'), 'required' => false)),
      'WebsitePracticeAreaId' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteMenuWebsitePracticeArea'), 'required' => false)),
      'ParentId'              => new sfValidatorInteger(array('required' => false)),
      'Title'                 => new sfValidatorString(array('max_length' => 150)),
      'Type'                  => new sfValidatorChoice(array('choices' => array(0 => 1, 1 => 2, 2 => 3))),
      'MenuType'              => new sfValidatorChoice(array('choices' => array(0 => 'Header', 1 => 'Footer'))),
      'Ordering'              => new sfValidatorInteger(),
      'CreateDateTime'        => new sfValidatorDateTime(),
      'UpdateDateTime'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('website_menu[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WebsiteMenu';
  }

}
