<?php

/**
 * Users form base class.
 *
 * @method Users getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'                         => new sfWidgetFormInputHidden(),
      'Email'                      => new sfWidgetFormInputText(),
      'Username'                   => new sfWidgetFormInputText(),
      'FirstName'                  => new sfWidgetFormInputText(),
      'MiddleName'                 => new sfWidgetFormInputText(),
      'LastName'                   => new sfWidgetFormInputText(),
      'Password'                   => new sfWidgetFormInputText(),
      'ProfilePic'                 => new sfWidgetFormInputText(),
      'Address1'                   => new sfWidgetFormInputText(),
      'Address2'                   => new sfWidgetFormInputText(),
      'City'                       => new sfWidgetFormInputText(),
      'CountyId'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsersCounties'), 'add_empty' => false)),
      'StateId'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsersStates'), 'add_empty' => false)),
      'Zip'                        => new sfWidgetFormInputText(),
      'Phone'                      => new sfWidgetFormInputText(),
      'ActivationCode'             => new sfWidgetFormInputText(),
      'BillingSubscription'        => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'WebsiteSubscriotion'        => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'NetworkProfileSubscription' => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'DefaultState'               => new sfWidgetFormInputText(),
      'UnderpayAmount'             => new sfWidgetFormInputText(),
      'UserType'                   => new sfWidgetFormChoice(array('choices' => array('' => '', 'Admin\'' => 'Admin\'', 'Staff' => 'Staff', 'Customer' => 'Customer', 'User' => 'User'))),
      'Status'                     => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Pending' => 'Pending', 'Deleted' => 'Deleted'))),
      'IsFeatured'                 => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'NoOfRating'                 => new sfWidgetFormInputText(),
      'AvgRating'                  => new sfWidgetFormInputText(),
      'PriorityListing'            => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'LastLoginDateTime'          => new sfWidgetFormDateTime(),
      'CreateDateTime'             => new sfWidgetFormDateTime(),
      'UpdateDateTime'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'                         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'Email'                      => new sfValidatorString(array('max_length' => 100)),
      'Username'                   => new sfValidatorString(array('max_length' => 100)),
      'FirstName'                  => new sfValidatorString(array('max_length' => 100)),
      'MiddleName'                 => new sfValidatorString(array('max_length' => 100)),
      'LastName'                   => new sfValidatorString(array('max_length' => 100)),
      'Password'                   => new sfValidatorString(array('max_length' => 150)),
      'ProfilePic'                 => new sfValidatorString(array('max_length' => 50)),
      'Address1'                   => new sfValidatorString(array('max_length' => 150)),
      'Address2'                   => new sfValidatorString(array('max_length' => 150)),
      'City'                       => new sfValidatorString(array('max_length' => 50)),
      'CountyId'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsersCounties'))),
      'StateId'                    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsersStates'))),
      'Zip'                        => new sfValidatorString(array('max_length' => 10)),
      'Phone'                      => new sfValidatorString(array('max_length' => 20)),
      'ActivationCode'             => new sfValidatorString(array('max_length' => 10)),
      'BillingSubscription'        => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'))),
      'WebsiteSubscriotion'        => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'))),
      'NetworkProfileSubscription' => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'))),
      'DefaultState'               => new sfValidatorInteger(),
      'UnderpayAmount'             => new sfValidatorNumber(array('required' => false)),
      'UserType'                   => new sfValidatorChoice(array('choices' => array(0 => '', 1 => 'Admin\'', 2 => 'Staff', 3 => 'Customer', 4 => 'User'), 'required' => false)),
      'Status'                     => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive', 2 => 'Pending', 3 => 'Deleted'), 'required' => false)),
      'IsFeatured'                 => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'), 'required' => false)),
      'NoOfRating'                 => new sfValidatorInteger(),
      'AvgRating'                  => new sfValidatorNumber(),
      'PriorityListing'            => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'))),
      'LastLoginDateTime'          => new sfValidatorDateTime(array('required' => false)),
      'CreateDateTime'             => new sfValidatorDateTime(),
      'UpdateDateTime'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('users[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Users';
  }

}
