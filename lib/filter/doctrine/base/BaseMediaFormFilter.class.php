<?php

/**
 * Media filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMediaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Title'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ImageName'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'OrgName'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Type'           => new sfWidgetFormChoice(array('choices' => array('' => '', 'BannerBackground' => 'BannerBackground', 'BannerForeground' => 'BannerForeground', 'Unsorted' => 'Unsorted', 'Logo' => 'Logo'))),
      'CreateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'Title'          => new sfValidatorPass(array('required' => false)),
      'ImageName'      => new sfValidatorPass(array('required' => false)),
      'OrgName'        => new sfValidatorPass(array('required' => false)),
      'Type'           => new sfValidatorChoice(array('required' => false, 'choices' => array('BannerBackground' => 'BannerBackground', 'BannerForeground' => 'BannerForeground', 'Unsorted' => 'Unsorted', 'Logo' => 'Logo'))),
      'CreateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('media_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Media';
  }

  public function getFields()
  {
    return array(
      'Id'             => 'Number',
      'Title'          => 'Text',
      'ImageName'      => 'Text',
      'OrgName'        => 'Text',
      'Type'           => 'Enum',
      'CreateDateTime' => 'Date',
      'UpdateDateTime' => 'Date',
    );
  }
}
