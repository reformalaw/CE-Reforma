<?php

/**
 * WebsiteMenu filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWebsiteMenuFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'WebsiteId'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteMenuUsersWebsite'), 'add_empty' => true)),
      'CmsPageId'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteMenuCMSPages'), 'add_empty' => true)),
      'WebsitePracticeAreaId' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteMenuWebsitePracticeArea'), 'add_empty' => true)),
      'ParentId'              => new sfWidgetFormFilterInput(),
      'Title'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Type'                  => new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 1, 2 => 2, 3 => 3))),
      'MenuType'              => new sfWidgetFormChoice(array('choices' => array('' => '', 'Header' => 'Header', 'Footer' => 'Footer'))),
      'Ordering'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CreateDateTime'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'WebsiteId'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('WebsiteMenuUsersWebsite'), 'column' => 'Id')),
      'CmsPageId'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('WebsiteMenuCMSPages'), 'column' => 'Id')),
      'WebsitePracticeAreaId' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('WebsiteMenuWebsitePracticeArea'), 'column' => 'Id')),
      'ParentId'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'Title'                 => new sfValidatorPass(array('required' => false)),
      'Type'                  => new sfValidatorChoice(array('required' => false, 'choices' => array(1 => 1, 2 => 2, 3 => 3))),
      'MenuType'              => new sfValidatorChoice(array('required' => false, 'choices' => array('Header' => 'Header', 'Footer' => 'Footer'))),
      'Ordering'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'CreateDateTime'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('website_menu_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WebsiteMenu';
  }

  public function getFields()
  {
    return array(
      'Id'                    => 'Number',
      'WebsiteId'             => 'ForeignKey',
      'CmsPageId'             => 'ForeignKey',
      'WebsitePracticeAreaId' => 'ForeignKey',
      'ParentId'              => 'Number',
      'Title'                 => 'Text',
      'Type'                  => 'Enum',
      'MenuType'              => 'Enum',
      'Ordering'              => 'Number',
      'CreateDateTime'        => 'Date',
      'UpdateDateTime'        => 'Date',
    );
  }
}
