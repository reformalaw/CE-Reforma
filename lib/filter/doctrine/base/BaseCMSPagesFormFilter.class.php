<?php

/**
 * CMSPages filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCMSPagesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'WebsiteId'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CMSPagesUserWebsite'), 'add_empty' => true)),
      'Title'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'SubTitle'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'MetaTitle'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'MetaKeywords'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'MetaDescription' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Content'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Template'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'column1' => 'column1', 'column2L' => 'column2L', 'column2R' => 'column2R', 'home' => 'home', 'default' => 'default'))),
      'Status'          => new sfWidgetFormChoice(array('choices' => array('' => '', 'Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'Type'            => new sfWidgetFormChoice(array('choices' => array('' => '', 'Static' => 'Static', 'Dynamic' => 'Dynamic'))),
      'UniqueKey'       => new sfWidgetFormFilterInput(),
      'Slug'            => new sfWidgetFormFilterInput(),
      'CreateDateTime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'WebsiteId'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CMSPagesUserWebsite'), 'column' => 'Id')),
      'Title'           => new sfValidatorPass(array('required' => false)),
      'SubTitle'        => new sfValidatorPass(array('required' => false)),
      'MetaTitle'       => new sfValidatorPass(array('required' => false)),
      'MetaKeywords'    => new sfValidatorPass(array('required' => false)),
      'MetaDescription' => new sfValidatorPass(array('required' => false)),
      'Content'         => new sfValidatorPass(array('required' => false)),
      'Template'        => new sfValidatorChoice(array('required' => false, 'choices' => array('column1' => 'column1', 'column2L' => 'column2L', 'column2R' => 'column2R', 'home' => 'home', 'default' => 'default'))),
      'Status'          => new sfValidatorChoice(array('required' => false, 'choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'Type'            => new sfValidatorChoice(array('required' => false, 'choices' => array('Static' => 'Static', 'Dynamic' => 'Dynamic'))),
      'UniqueKey'       => new sfValidatorPass(array('required' => false)),
      'Slug'            => new sfValidatorPass(array('required' => false)),
      'CreateDateTime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('cms_pages_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CMSPages';
  }

  public function getFields()
  {
    return array(
      'Id'              => 'Number',
      'WebsiteId'       => 'ForeignKey',
      'Title'           => 'Text',
      'SubTitle'        => 'Text',
      'MetaTitle'       => 'Text',
      'MetaKeywords'    => 'Text',
      'MetaDescription' => 'Text',
      'Content'         => 'Text',
      'Template'        => 'Enum',
      'Status'          => 'Enum',
      'Type'            => 'Enum',
      'UniqueKey'       => 'Text',
      'Slug'            => 'Text',
      'CreateDateTime'  => 'Date',
      'UpdateDateTime'  => 'Date',
    );
  }
}
