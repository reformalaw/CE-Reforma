<?php

class RegistrationForm extends BaseUsersForm {
	public function configure() {
		parent::configure();

		unset(
		$this['id'],
		$this['ProfilePic'],
		$this['Address1'],
		$this['Address2'],
		$this['City'],
		$this['CountryId'],
		$this['Zip'],
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
		'FirstName'                    	=>  new sfWidgetFormInputText(),
		'LastName'                     	=>  new sfWidgetFormInputText(),
		//'Username'                     =>  new sfWidgetFormInputText(),
		'Email'                        	=>  new sfWidgetFormInputText(),
		'Confirm_Email'                 	=>  new sfWidgetFormInputText(),
		'Password'                     	=>  new sfWidgetFormInputPassword(),
		'Confirm_Password'  				=>  new sfWidgetFormInputPassword(),
		'StateId'                      	=>  new sfWidgetFormDoctrineChoice(
											//array('model'=>$this->getRelatedModelName('UsersStates'),'add_empty'=>'Select State')
											array(
												'model' 		=> $this->getRelatedModelName('UsersStates'),
												'query' 		=>  Doctrine_Query::create()->select('s.Id, s.Name')->from('States s')->where('s.CountryId = ?', sfConfig::get('app_State_UsStateId') )->andWhere('s.Status = ?','Active'),
												'multiple' 	=> false,
												'add_empty'	=> 'Select State',
												'order_by' 	=> array('Name', 'asc')
											)),
		'Captcha'                    	=>  new sfWidgetFormInputText(),
		));

		$this->widgetSchema->setLabels(array(
		'FirstName'                 	=> 'First Name :',
		'LastName'                  	=> 'Last Name :',
		//'Username'                  => 'User Name :',
		'Email'                     	=> 'Email :',
		'Password'                  	=> 'Password :',
		'Confirm_Password'  			=> 'Confirm Password :',
		'StateId'                   	=> 'State :',
		'Captcha'                   	=> 'Captcha :',
		'Confirm_Email'				=> "Confirm Email :"
		));


		$this->setValidators(array(
		'FirstName'                     	=> new sfValidatorString(array('required' => true,'min_length' => 2,'max_length'=>45),array('required'=>'This field is required.','min_length'=>'First name  must be at least 2 characters long.','max_length'=>'First name cannot be longer than 45 characters.')),
		'LastName'                      	=> new sfValidatorString(array('required' => true,'min_length' => 2,'max_length'=>45),array('required'=>'This field is required.','min_length'=>'Last  name  must be at least 2 characters long.','max_length'=>'Last name cannot be longer than 45 characters.')),
		//'Username'                      => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>50),array('required'=>'Please Enter User Name','min_length'=>'Please Enter More than 3 characters','max_length'=>'Please Enter Less than 50 characters')),
		'Email'                         	=> new sfValidatorEmail(array('max_length' => 70, 'required' => true), array('required' => 'This field is required.', 'invalid' => 'Please enter valid e-mail address.','max_length'=>'E-mail address cannot be longer than 70 characters.')),
		'Password'                      	=> new sfValidatorString(array('required' => false,'min_length' => 6), array('required' => 'This field is required.','min_length'=>'Password must be atleast 6 characters long.')),
		'Confirm_Password'          		=> new sfValidatorString(array('required' => false,'min_length' => 6), array('min_length'=>'Password must be atleast 6 characters long.')),
		'StateId'                       	=> new sfValidatorString(array('required' => true),array('required'=>'Please select your state')),
		'Captcha'                      	=> new sfValidatorSfCryptoCaptcha(array('required' => true, 'trim' => true),array('wrong_captcha' => 'Please enter valid captcha.','required' => 'This field is required.')),
		'Confirm_Email'                  => new sfValidatorEmail(array('max_length' => 70, 'required' => false), array('required' => 'This field is required.', 'invalid' => 'Please enter valid e-mail address.','max_length'=>'E-mail address cannot be longer than 70 characters.')),
		));


		$this->validatorSchema->setPostValidator(new sfValidatorAnd( array(
		new sfValidatorDoctrineUnique(array( 'model' => 'Users', 'column' => 'Email', 'primary_key' => 'Id', 'required' => true, 'throw_global_error' => false ),array('invalid' => "Email is already in use")),
		new sfValidatorDoctrineUnique(array( 'model' => 'Users', 'column' => 'Username', 'primary_key' => 'Id', 'required' => true, 'throw_global_error' => false ),array('invalid' => "User Name is already in use"))
		)));


		$this->validatorSchema->setOption('allow_extra_fields', true);
		$this->widgetSchema->setNameFormat('registration[%s]');
	}
}
?>