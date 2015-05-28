<?php

/**
 * Theme filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseThemeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Name'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'UniqueName'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ScreenShot'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Status'                   => new sfWidgetFormChoice(array('choices' => array('' => '', 'Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'IsDefault'                => new sfWidgetFormChoice(array('choices' => array('' => '', 'YES' => 'YES', 'NO' => 'NO'))),
      'Features'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Options'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ManageTopMenu'            => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'ManageFooterMenu'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'ManageBanner'             => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'ManageColorAndBackground' => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'ManageSocialMedia'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'ChangeLogo'               => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'ManageFAQs'               => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'TextWidgets'              => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'BodyBackground'           => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'CreateDateTime'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'Name'                     => new sfValidatorPass(array('required' => false)),
      'UniqueName'               => new sfValidatorPass(array('required' => false)),
      'ScreenShot'               => new sfValidatorPass(array('required' => false)),
      'Status'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'IsDefault'                => new sfValidatorChoice(array('required' => false, 'choices' => array('YES' => 'YES', 'NO' => 'NO'))),
      'Features'                 => new sfValidatorPass(array('required' => false)),
      'Options'                  => new sfValidatorPass(array('required' => false)),
      'ManageTopMenu'            => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'ManageFooterMenu'         => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'ManageBanner'             => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'ManageColorAndBackground' => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'ManageSocialMedia'        => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'ChangeLogo'               => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'ManageFAQs'               => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'TextWidgets'              => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'BodyBackground'           => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'CreateDateTime'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('theme_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Theme';
  }

  public function getFields()
  {
    return array(
      'Id'                       => 'Number',
      'Name'                     => 'Text',
      'UniqueName'               => 'Text',
      'ScreenShot'               => 'Text',
      'Status'                   => 'Enum',
      'IsDefault'                => 'Enum',
      'Features'                 => 'Text',
      'Options'                  => 'Text',
      'ManageTopMenu'            => 'Enum',
      'ManageFooterMenu'         => 'Enum',
      'ManageBanner'             => 'Enum',
      'ManageColorAndBackground' => 'Enum',
      'ManageSocialMedia'        => 'Enum',
      'ChangeLogo'               => 'Enum',
      'ManageFAQs'               => 'Enum',
      'TextWidgets'              => 'Enum',
      'BodyBackground'           => 'Enum',
      'CreateDateTime'           => 'Date',
      'UpdateDateTime'           => 'Date',
    );
  }
}
