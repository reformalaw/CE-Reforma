<?php

/**
 * AttorneyContact filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAttorneyContactFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'UserId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AttorneyContactUsers'), 'add_empty' => true)),
      'Label'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'FieldType'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Options'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Required'       => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'Ordering'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'OptionsSlug'    => new sfWidgetFormFilterInput(),
      'CreateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'UserId'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AttorneyContactUsers'), 'column' => 'Id')),
      'Label'          => new sfValidatorPass(array('required' => false)),
      'FieldType'      => new sfValidatorPass(array('required' => false)),
      'Options'        => new sfValidatorPass(array('required' => false)),
      'Required'       => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'Ordering'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'OptionsSlug'    => new sfValidatorPass(array('required' => false)),
      'CreateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('attorney_contact_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AttorneyContact';
  }

  public function getFields()
  {
    return array(
      'Id'             => 'Number',
      'UserId'         => 'ForeignKey',
      'Label'          => 'Text',
      'FieldType'      => 'Text',
      'Options'        => 'Text',
      'Required'       => 'Enum',
      'Ordering'       => 'Number',
      'OptionsSlug'    => 'Text',
      'CreateDateTime' => 'Date',
      'UpdateDateTime' => 'Date',
    );
  }
}
