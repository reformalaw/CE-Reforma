<?php

/**
 * WebsiteXFAQs filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWebsiteXFAQsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'FAQId'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteXFAQsFAQs'), 'add_empty' => true)),
      'WebsiteId'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WebsiteXFAQsUsersWebsite'), 'add_empty' => true)),
      'Ordering'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'Active' => 'Active', 'Inactive' => 'Inactive'))),
      'CreateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'FAQId'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('WebsiteXFAQsFAQs'), 'column' => 'Id')),
      'WebsiteId'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('WebsiteXFAQsUsersWebsite'), 'column' => 'Id')),
      'Ordering'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'Status'         => new sfValidatorChoice(array('required' => false, 'choices' => array('Active' => 'Active', 'Inactive' => 'Inactive'))),
      'CreateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('website_xfa_qs_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WebsiteXFAQs';
  }

  public function getFields()
  {
    return array(
      'Id'             => 'Number',
      'FAQId'          => 'ForeignKey',
      'WebsiteId'      => 'ForeignKey',
      'Ordering'       => 'Number',
      'Status'         => 'Enum',
      'CreateDateTime' => 'Date',
      'UpdateDateTime' => 'Date',
    );
  }
}
