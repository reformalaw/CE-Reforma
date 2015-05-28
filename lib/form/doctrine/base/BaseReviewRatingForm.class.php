<?php

/**
 * ReviewRating form base class.
 *
 * @method ReviewRating getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseReviewRatingForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'UserId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ReviewRatingUsers'), 'add_empty' => false)),
      'CustomerId'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ReviewRatingCustomers'), 'add_empty' => false)),
      'Rate'           => new sfWidgetFormInputText(),
      'Review'         => new sfWidgetFormTextarea(),
      'Spam'           => new sfWidgetFormChoice(array('choices' => array(0 => '0', 1 => '1'))),
      'Status'         => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive'))),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'UserId'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ReviewRatingUsers'))),
      'CustomerId'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ReviewRatingCustomers'))),
      'Rate'           => new sfValidatorInteger(),
      'Review'         => new sfValidatorString(),
      'Spam'           => new sfValidatorChoice(array('choices' => array(0 => '0', 1 => '1'), 'required' => false)),
      'Status'         => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive'))),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('review_rating[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ReviewRating';
  }

}
