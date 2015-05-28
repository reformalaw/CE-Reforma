<?php

/**
 * CMSPages form base class.
 *
 * @method CMSPages getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCMSPagesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'              => new sfWidgetFormInputHidden(),
      'WebsiteId'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CMSPagesUserWebsite'), 'add_empty' => true)),
      'Title'           => new sfWidgetFormInputText(),
      'SubTitle'        => new sfWidgetFormInputText(),
      'MetaTitle'       => new sfWidgetFormInputText(),
      'MetaKeywords'    => new sfWidgetFormInputText(),
      'MetaDescription' => new sfWidgetFormTextarea(),
      'Content'         => new sfWidgetFormTextarea(),
      'Template'        => new sfWidgetFormChoice(array('choices' => array('column1' => 'column1', 'column2L' => 'column2L', 'column2R' => 'column2R', 'home' => 'home', 'default' => 'default'))),
      'Status'          => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'Type'            => new sfWidgetFormChoice(array('choices' => array('Static' => 'Static', 'Dynamic' => 'Dynamic'))),
      'UniqueKey'       => new sfWidgetFormInputText(),
      'Slug'            => new sfWidgetFormInputText(),
      'CreateDateTime'  => new sfWidgetFormDateTime(),
      'UpdateDateTime'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'WebsiteId'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CMSPagesUserWebsite'), 'required' => false)),
      'Title'           => new sfValidatorString(array('max_length' => 150)),
      'SubTitle'        => new sfValidatorString(array('max_length' => 150)),
      'MetaTitle'       => new sfValidatorString(array('max_length' => 150)),
      'MetaKeywords'    => new sfValidatorString(array('max_length' => 250)),
      'MetaDescription' => new sfValidatorString(),
      'Content'         => new sfValidatorString(),
      'Template'        => new sfValidatorChoice(array('choices' => array(0 => 'column1', 1 => 'column2L', 2 => 'column2R', 3 => 'home', 4 => 'default'))),
      'Status'          => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive', 2 => 'Deleted'))),
      'Type'            => new sfValidatorChoice(array('choices' => array(0 => 'Static', 1 => 'Dynamic'))),
      'UniqueKey'       => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'Slug'            => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'CreateDateTime'  => new sfValidatorDateTime(),
      'UpdateDateTime'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('cms_pages[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CMSPages';
  }

}
