<?php

/**
 * Users filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUsersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Email'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Username'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'FirstName'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'MiddleName'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'LastName'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Password'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ProfilePic'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Address1'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Address2'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'City'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CountyId'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsersCounties'), 'add_empty' => true)),
      'StateId'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsersStates'), 'add_empty' => true)),
      'Zip'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Phone'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ActivationCode'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'BillingSubscription'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'WebsiteSubscriotion'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'NetworkProfileSubscription' => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'DefaultState'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'UnderpayAmount'             => new sfWidgetFormFilterInput(),
      'UserType'                   => new sfWidgetFormChoice(array('choices' => array('' => '', 'Admin\'' => 'Admin\'', 'Staff' => 'Staff', 'Customer' => 'Customer', 'User' => 'User'))),
      'Status'                     => new sfWidgetFormChoice(array('choices' => array('' => '', 'Active' => 'Active', 'Inactive' => 'Inactive', 'Pending' => 'Pending', 'Deleted' => 'Deleted'))),
      'IsFeatured'                 => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'NoOfRating'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'AvgRating'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'PriorityListing'            => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'LastLoginDateTime'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'CreateDateTime'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'Email'                      => new sfValidatorPass(array('required' => false)),
      'Username'                   => new sfValidatorPass(array('required' => false)),
      'FirstName'                  => new sfValidatorPass(array('required' => false)),
      'MiddleName'                 => new sfValidatorPass(array('required' => false)),
      'LastName'                   => new sfValidatorPass(array('required' => false)),
      'Password'                   => new sfValidatorPass(array('required' => false)),
      'ProfilePic'                 => new sfValidatorPass(array('required' => false)),
      'Address1'                   => new sfValidatorPass(array('required' => false)),
      'Address2'                   => new sfValidatorPass(array('required' => false)),
      'City'                       => new sfValidatorPass(array('required' => false)),
      'CountyId'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UsersCounties'), 'column' => 'Id')),
      'StateId'                    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UsersStates'), 'column' => 'Id')),
      'Zip'                        => new sfValidatorPass(array('required' => false)),
      'Phone'                      => new sfValidatorPass(array('required' => false)),
      'ActivationCode'             => new sfValidatorPass(array('required' => false)),
      'BillingSubscription'        => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'WebsiteSubscriotion'        => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'NetworkProfileSubscription' => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'DefaultState'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'UnderpayAmount'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'UserType'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('' => '', 'Admin\'' => 'Admin\'', 'Staff' => 'Staff', 'Customer' => 'Customer', 'User' => 'User'))),
      'Status'                     => new sfValidatorChoice(array('required' => false, 'choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Pending' => 'Pending', 'Deleted' => 'Deleted'))),
      'IsFeatured'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'NoOfRating'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'AvgRating'                  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'PriorityListing'            => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'LastLoginDateTime'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'CreateDateTime'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('users_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Users';
  }

  public function getFields()
  {
    return array(
      'Id'                         => 'Number',
      'Email'                      => 'Text',
      'Username'                   => 'Text',
      'FirstName'                  => 'Text',
      'MiddleName'                 => 'Text',
      'LastName'                   => 'Text',
      'Password'                   => 'Text',
      'ProfilePic'                 => 'Text',
      'Address1'                   => 'Text',
      'Address2'                   => 'Text',
      'City'                       => 'Text',
      'CountyId'                   => 'ForeignKey',
      'StateId'                    => 'ForeignKey',
      'Zip'                        => 'Text',
      'Phone'                      => 'Text',
      'ActivationCode'             => 'Text',
      'BillingSubscription'        => 'Enum',
      'WebsiteSubscriotion'        => 'Enum',
      'NetworkProfileSubscription' => 'Enum',
      'DefaultState'               => 'Number',
      'UnderpayAmount'             => 'Number',
      'UserType'                   => 'Enum',
      'Status'                     => 'Enum',
      'IsFeatured'                 => 'Enum',
      'NoOfRating'                 => 'Number',
      'AvgRating'                  => 'Number',
      'PriorityListing'            => 'Enum',
      'LastLoginDateTime'          => 'Date',
      'CreateDateTime'             => 'Date',
      'UpdateDateTime'             => 'Date',
    );
  }
}
