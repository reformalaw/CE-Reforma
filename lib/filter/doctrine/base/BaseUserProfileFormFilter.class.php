<?php

/**
 * UserProfile filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUserProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'UserId'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserProfileUsers'), 'add_empty' => true)),
      'FirmName'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Address1'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Address2'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'City'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'StateId'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserProfileStates'), 'add_empty' => true)),
      'Zip'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Phone'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Summary'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'FeesInformation'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'FreeConsultation' => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'CreateDateTime'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'UserId'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserProfileUsers'), 'column' => 'Id')),
      'FirmName'         => new sfValidatorPass(array('required' => false)),
      'Address1'         => new sfValidatorPass(array('required' => false)),
      'Address2'         => new sfValidatorPass(array('required' => false)),
      'City'             => new sfValidatorPass(array('required' => false)),
      'StateId'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserProfileStates'), 'column' => 'Id')),
      'Zip'              => new sfValidatorPass(array('required' => false)),
      'Phone'            => new sfValidatorPass(array('required' => false)),
      'Summary'          => new sfValidatorPass(array('required' => false)),
      'FeesInformation'  => new sfValidatorPass(array('required' => false)),
      'FreeConsultation' => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'CreateDateTime'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserProfile';
  }

  public function getFields()
  {
    return array(
      'Id'               => 'Number',
      'UserId'           => 'ForeignKey',
      'FirmName'         => 'Text',
      'Address1'         => 'Text',
      'Address2'         => 'Text',
      'City'             => 'Text',
      'StateId'          => 'ForeignKey',
      'Zip'              => 'Text',
      'Phone'            => 'Text',
      'Summary'          => 'Text',
      'FeesInformation'  => 'Text',
      'FreeConsultation' => 'Enum',
      'CreateDateTime'   => 'Date',
      'UpdateDateTime'   => 'Date',
    );
  }
}
