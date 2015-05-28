<?php

/**
 * ThemeOptions filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseThemeOptionsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ThemeId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ThemeOptionsTheme'), 'add_empty' => true)),
      'WebsiteId'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'OptionKey'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'OptionValue'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CreateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'ThemeId'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ThemeOptionsTheme'), 'column' => 'Id')),
      'WebsiteId'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'OptionKey'      => new sfValidatorPass(array('required' => false)),
      'OptionValue'    => new sfValidatorPass(array('required' => false)),
      'CreateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('theme_options_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ThemeOptions';
  }

  public function getFields()
  {
    return array(
      'Id'             => 'Number',
      'ThemeId'        => 'ForeignKey',
      'WebsiteId'      => 'Number',
      'OptionKey'      => 'Text',
      'OptionValue'    => 'Text',
      'CreateDateTime' => 'Date',
      'UpdateDateTime' => 'Date',
    );
  }
}
