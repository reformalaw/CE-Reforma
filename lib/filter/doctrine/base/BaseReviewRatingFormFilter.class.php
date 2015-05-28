<?php

/**
 * ReviewRating filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseReviewRatingFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'UserId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ReviewRatingUsers'), 'add_empty' => true)),
      'CustomerId'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ReviewRatingCustomers'), 'add_empty' => true)),
      'Rate'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Review'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Spam'           => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => '0', 1 => '1'))),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'Active' => 'Active', 'Inactive' => 'Inactive'))),
      'CreateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'UserId'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ReviewRatingUsers'), 'column' => 'Id')),
      'CustomerId'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ReviewRatingCustomers'), 'column' => 'Id')),
      'Rate'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'Review'         => new sfValidatorPass(array('required' => false)),
      'Spam'           => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => '0', 1 => '1'))),
      'Status'         => new sfValidatorChoice(array('required' => false, 'choices' => array('Active' => 'Active', 'Inactive' => 'Inactive'))),
      'CreateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('review_rating_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ReviewRating';
  }

  public function getFields()
  {
    return array(
      'Id'             => 'Number',
      'UserId'         => 'ForeignKey',
      'CustomerId'     => 'ForeignKey',
      'Rate'           => 'Number',
      'Review'         => 'Text',
      'Spam'           => 'Enum',
      'Status'         => 'Enum',
      'CreateDateTime' => 'Date',
      'UpdateDateTime' => 'Date',
    );
  }
}
