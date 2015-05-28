<?php

/**
 * AttorneyStatistics form base class.
 *
 * @method AttorneyStatistics getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAttorneyStatisticsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'UserId'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AttorneyStatisticsUsers'), 'add_empty' => false)),
      'IpAddress'      => new sfWidgetFormInputText(),
      'VisitDate'      => new sfWidgetFormDate(),
      'Type'           => new sfWidgetFormChoice(array('choices' => array('Profile' => 'Profile', 'Contact' => 'Contact'))),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'UserId'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AttorneyStatisticsUsers'))),
      'IpAddress'      => new sfValidatorString(array('max_length' => 150)),
      'VisitDate'      => new sfValidatorDate(array('required' => false)),
      'Type'           => new sfValidatorChoice(array('choices' => array(0 => 'Profile', 1 => 'Contact'))),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('attorney_statistics[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AttorneyStatistics';
  }

}
