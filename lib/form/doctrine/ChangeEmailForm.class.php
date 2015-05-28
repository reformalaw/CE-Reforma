<?php

class ChangeEmailForm extends BaseUsersForm {

    public function configure() {
        parent::configure();

         unset(
			$this['Id'],
			$this['ProfilePic'],
			$this['City'],
			$this['CountryId'],
			$this['StateId'],
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
			$this['CreateDateTime'],
			$this['FirstName'],
			$this['LastName'],
			$this['Address1'],
			$this['Address2'],
			$this['City'],
			$this['StateId'],
			$this['Zip']
        );

        $this->setWidgets(array(
        'Email'             => 	new sfWidgetFormInputText(array(), array('style'=>'width:300px')),
        'Password'          =>  new sfWidgetFormInputPassword(array(),array('style'=>'width:300px')),
        'Confirm_Email'             => 	new sfWidgetFormInputText(array(), array('style'=>'width:300px')),
        'Confirm_Password'          =>  new sfWidgetFormInputPassword(array(),array('style'=>'width:300px'))
        ));

        $this->widgetSchema->setLabels(array(
        'Email'             => 'New Email ',
        'Password'          => 'Password',
        'Confirm_Email'     => 'Confirm Email ',
        'Confirm_Password'  => 'Confirm Password',
        ));

        $this->setValidators(array(
        'Email'             => new sfValidatorEmail(array('max_length' => 45, 'required' => true), array('required' => 'This field is required.', 'invalid' => 'Please enter valid e-mail address','max_length'=>'E-mail address cannot be longer than 45 characters.')),
        'Password'          => new sfValidatorString(array('required' => true,'min_length' => 5), array('min_length'=>'Password must be at least %min_length% characters long.')),
        'Confirm_Email'     => new sfValidatorEmail(array('max_length' => 45, 'required' => false), array('required' => 'This field is required.', 'invalid' => 'Please enter valid e-mail address','max_length'=>'E-mail address cannot be longer than 45 characters.')),
        'Confirm_Password'  => new sfValidatorString(array('required' => false,'min_length' => 5), array('min_length'=>'Password must be at least %min_length% characters long.')),
        ));

//         $this->validatorSchema->setPostValidator(new sfValidatorAnd( array(
//             new sfValidatorDoctrineUnique(array( 'model' => 'Users', 'column' => 'Email', 'primary_key' => 'Id', 'required' => true, 'throw_global_error' => false ),array('invalid' => "Email is already in use"))
//             )));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('changeEmail[%s]');
    }
}
?>
