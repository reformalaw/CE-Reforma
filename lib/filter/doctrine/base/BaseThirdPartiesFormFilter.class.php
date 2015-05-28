<?php

/**
 * ThirdParties filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseThirdPartiesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Name'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Address1'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Address2'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'City'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CountryId'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CountyId'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ThirdPartiesCounties'), 'add_empty' => true)),
      'StateId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ThirdPartiesStates'), 'add_empty' => true)),
      'Zip'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'CreateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'Name'           => new sfValidatorPass(array('required' => false)),
      'Address1'       => new sfValidatorPass(array('required' => false)),
      'Address2'       => new sfValidatorPass(array('required' => false)),
      'City'           => new sfValidatorPass(array('required' => false)),
      'CountryId'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'CountyId'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ThirdPartiesCounties'), 'column' => 'Id')),
      'StateId'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ThirdPartiesStates'), 'column' => 'Id')),
      'Zip'            => new sfValidatorPass(array('required' => false)),
      'Status'         => new sfValidatorChoice(array('required' => false, 'choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'CreateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('third_parties_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ThirdParties';
  }

  public function getFields()
  {
    return array(
      'Id'             => 'Number',
      'Name'           => 'Text',
      'Address1'       => 'Text',
      'Address2'       => 'Text',
      'City'           => 'Text',
      'CountryId'      => 'Number',
      'CountyId'       => 'ForeignKey',
      'StateId'        => 'ForeignKey',
      'Zip'            => 'Text',
      'Status'         => 'Enum',
      'CreateDateTime' => 'Date',
      'UpdateDateTime' => 'Date',
    );
  }
}
