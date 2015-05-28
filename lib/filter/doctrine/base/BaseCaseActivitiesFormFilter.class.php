<?php

/**
 * CaseActivities filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCaseActivitiesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'CaseId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CaseActivitiesCases'), 'add_empty' => true)),
      'ActivityType'   => new sfWidgetFormChoice(array('choices' => array('' => '', 'CustomerBillsSubmitted' => 'CustomerBillsSubmitted', '3rdPartyBillsSubmitted' => '3rdPartyBillsSubmitted', '3rdPartyBillsRejected' => '3rdPartyBillsRejected', 'CheckSent' => 'CheckSent', 'PaymentReceived' => 'PaymentReceived'))),
      'Description'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CreateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'CaseId'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CaseActivitiesCases'), 'column' => 'Id')),
      'ActivityType'   => new sfValidatorChoice(array('required' => false, 'choices' => array('CustomerBillsSubmitted' => 'CustomerBillsSubmitted', '3rdPartyBillsSubmitted' => '3rdPartyBillsSubmitted', '3rdPartyBillsRejected' => '3rdPartyBillsRejected', 'CheckSent' => 'CheckSent', 'PaymentReceived' => 'PaymentReceived'))),
      'Description'    => new sfValidatorPass(array('required' => false)),
      'CreateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('case_activities_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CaseActivities';
  }

  public function getFields()
  {
    return array(
      'Id'             => 'Number',
      'CaseId'         => 'ForeignKey',
      'ActivityType'   => 'Enum',
      'Description'    => 'Text',
      'CreateDateTime' => 'Date',
      'UpdateDateTime' => 'Date',
    );
  }
}
