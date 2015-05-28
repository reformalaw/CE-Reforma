<?php

class MyProfileForm extends BaseUsersForm {

    public function configure() {
        parent::configure();

        unset(
        $this['Id'],
        $this['CountryId'],
        $this['ActivationCode'],
        $this['BillingSubscription'],
        $this['WebsiteSubscriotion'],
        $this['NetworkProfileSubscription'],
        $this['DefaultState'],
        $this['UnderpayAmount'],
        $this['UserType'],
        $this['Status'],
        $this['LastLoginDateTime'],
        $this['UpdateDateTime'],
        $this['CreateDateTime']
        );

        $this->setWidgets(array(
        'FirstName'         =>  new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
	 'MiddleName'        =>  new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
        'LastName'          =>  new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
        'Password'          =>  new sfWidgetFormInputPassword(array(),array('style'=>'width:300px')),
        'New_Password'      =>  new sfWidgetFormInputPassword(array(),array('style'=>'width:300px')),
        'Confirm_Password'  =>  new sfWidgetFormInputPassword(array(),array('style'=>'width:300px')),
        'Address1'          =>  new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
        'Address2'          =>  new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
        'Phone'						=>  new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
        'City'                         =>  new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
        'StateId'                      =>  new sfWidgetFormDoctrineChoice(
        array(
        'model' 		=> $this->getRelatedModelName('UsersStates'),
        'query' 		=>  Doctrine_Query::create()->select('s.Id, s.Name')->from('States s')->where('s.CountryId = ?', sfConfig::get('app_State_UsStateId') )->andWhere('s.Status = ?','Active'),
        'multiple' 	=> false,
        'add_empty'	=> 'Select State',
        'order_by' 	=> array('Name', 'asc')
        ),array('style'=>'width:300px')
        ),
        'Zip'                         =>  new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
        'ProfilePic' 		=> new sfWidgetFormInputFile(),
        ));

        $this->widgetSchema->setLabels(array(
        'FirstName'         => 'Test Name ',
        'MiddleName'        => 'Middle Name ',
        'LastName'          => 'Last Name ',
        'Username'          => 'User Name ',
        'Email'             => 'Email ',
        'Password'          => 'Current Password ',
        'New_Password'      => 'New Password',
        'Confirm_Password'  => 'Confirm Password',
        'Address1'          => 'Address 1 ',
        'Address2'          => 'Address 2 ',
        'City'              => 'City ',
        'StateId'           => 'State ',
        'Zip'               => 'Zip Code ',
        'ProfilePic'        => 'Profile Picture',
        'Phone'				=> 'Phone'
        ));


        $this->setValidators(array(
        'FirstName'         => new sfValidatorString(array('required' => true,'min_length' => 2,'max_length'=>45),array('required'=>'This field is required.','min_length'=>'First name  must be at least 2 characters long.','max_length'=>'First name cannot be longer than 45 characters.')),
        'MiddleName'        => new sfValidatorString(array('required' => false,'min_length' => 1,'max_length'=>45),array('required'=>'This field is required.','min_length'=>'Middle name  must be at least 1 characters long.','max_length'=>'Last name cannot be longer than 45 characters.')),
        'LastName'          => new sfValidatorString(array('required' => true,'min_length' => 2,'max_length'=>45),array('required'=>'This field is required.','min_length'=>'Last  name  must be at least 2 characters long.','max_length'=>'Last name cannot be longer than 45 characters.')),
        'Password'          => new sfValidatorString(array('required' => false,'min_length' => 6), array('min_length'=>'Password must be at least %min_length% characters long.')),
        'New_Password'          => new sfValidatorString(array('required' => false,'min_length' => 6), array('min_length'=>'password must be at least %min_length% characters long.')),
        'Confirm_Password'          => new sfValidatorString(array('required' => false,'min_length' => 6), array('min_length'=>'Password must be at least %min_length% characters long.')),
        'Address1'          => new sfValidatorString(array('required' => true), array('required' => 'This field is required.')),
        'Address2'          => new sfValidatorString(array('required' => false)),
        'Phone'                         => new sfValidatorString(array('required' => true)),
        'City'                          => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>45),array('required'=>'This field is required.','min_length'=>'City name must be at least 3 characters long.','max_length'=>'City name cannot be longer than 45 characters.')),
        'StateId'                       => new sfValidatorString(array('required' => true),array('required'=>'This field is required.')),
        'Zip'                           => new sfValidatorNumber(array('required' => false)),
        'ProfilePic' 		=> new sfValidatorFile(array('required' => true,'required'=>$this->isNew()),array('required' => 'Please provide a valid image.')),
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('myprofile[%s]');
    }
}
?>