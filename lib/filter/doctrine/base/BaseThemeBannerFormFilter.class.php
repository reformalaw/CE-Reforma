<?php

/**
 * ThemeBanner filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseThemeBannerFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ThemeId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ThemeBannerTheme'), 'add_empty' => true)),
      'WebsiteId'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ThemeBannerUserWebsite'), 'add_empty' => true)),
      'BannerName'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Image'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Title1'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Title2'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Title3'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'Active' => 'Active', 'Inactive' => 'Inactive'))),
      'CreateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'ThemeId'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ThemeBannerTheme'), 'column' => 'Id')),
      'WebsiteId'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ThemeBannerUserWebsite'), 'column' => 'Id')),
      'BannerName'     => new sfValidatorPass(array('required' => false)),
      'Image'          => new sfValidatorPass(array('required' => false)),
      'Title1'         => new sfValidatorPass(array('required' => false)),
      'Title2'         => new sfValidatorPass(array('required' => false)),
      'Title3'         => new sfValidatorPass(array('required' => false)),
      'Status'         => new sfValidatorChoice(array('required' => false, 'choices' => array('Active' => 'Active', 'Inactive' => 'Inactive'))),
      'CreateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('theme_banner_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ThemeBanner';
  }

  public function getFields()
  {
    return array(
      'Id'             => 'Number',
      'ThemeId'        => 'ForeignKey',
      'WebsiteId'      => 'ForeignKey',
      'BannerName'     => 'Text',
      'Image'          => 'Text',
      'Title1'         => 'Text',
      'Title2'         => 'Text',
      'Title3'         => 'Text',
      'Status'         => 'Enum',
      'CreateDateTime' => 'Date',
      'UpdateDateTime' => 'Date',
    );
  }
}
