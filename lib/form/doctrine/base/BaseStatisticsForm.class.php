<?php

/**
 * Statistics form base class.
 *
 * @method Statistics getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStatisticsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'WebsiteId'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('StatisticsUsersWebsite'), 'add_empty' => false)),
      'IpAddress'      => new sfWidgetFormInputText(),
      'VisitDate'      => new sfWidgetFormDate(),
      'CreateDateTime' => new sfWidgetFormDateTime(),
      'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'WebsiteId'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('StatisticsUsersWebsite'))),
      'IpAddress'      => new sfValidatorString(array('max_length' => 150)),
      'VisitDate'      => new sfValidatorDate(array('required' => false)),
      'CreateDateTime' => new sfValidatorDateTime(),
      'UpdateDateTime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('statistics[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Statistics';
  }

}
