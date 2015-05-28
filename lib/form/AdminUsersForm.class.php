<?php

class AdminUsersForm extends BaseUsersForm {

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
        $this['CreateDateTime']
        );
        
        $query = RolesTable::getRoleList();
        
        $this->setWidgets(array(
        'FirstName'         =>  new sfWidgetFormInputText(),
        'LastName'          =>  new sfWidgetFormInputText(),
        //'Username'          =>  new sfWidgetFormInputText(),
        'Email'             => 	new sfWidgetFormInputText(),
        'Password'          =>  new sfWidgetFormInputPassword(),
        'Confirm_Email'     => 	new sfWidgetFormInputText(),
        'Confirm_Password'  =>  new sfWidgetFormInputPassword(),
        'Address1'          =>  new sfWidgetFormInputText(),
        'Address2'          =>  new sfWidgetFormInputText(),
        'Phone'				=>  new sfWidgetFormInputText(),
        'selectAll'         =>  new sfWidgetFormSelectCheckbox(array('choices'=>array(''=>'Select All'))),
        'Roles'             =>  new sfWidgetFormSelectCheckbox(array('choices' =>$query))
        ));

        $this->widgetSchema->setLabels(array(
        'FirstName'         => 'First Name ',
        'LastName'          => 'Last Name ',
        //'Username'          => 'User Name ',
        'Email'             => 'Email ',
        'Password'          => 'Password ',
        'Confirm_Email'     => 'Confirm Email ',
        'Confirm_Password'  => 'Confirm Password ',
        'Address1'          => 'Address 1 ',
        'Address2'          => 'Address 2 ',
        'selectAll'         => 'Select Roles ',
        'Roles'             => 'Roles ',
        'Phone'				=> 'Phone'
        ));

        $this->setValidators(array(
        'FirstName'         => new sfValidatorString(array('required' => true,'min_length' => 2,'max_length'=>45),array('required'=>'This field is required.','min_length'=>'First name  must be at least 2 characters long.','max_length'=>'First name cannot be longer than 45 characters.')),
        'LastName'          => new sfValidatorString(array('required' => true,'min_length' => 2,'max_length'=>45),array('required'=>'This field is required.','min_length'=>'Last  name  must be at least 2 characters long.','max_length'=>'Last name cannot be longer than 45 characters.')),
        //'Username'          => new sfValidatorString(array('required' => $this->isNew(),'min_length' => 3,'max_length'=>50),array('required'=>'Please enter Username','min_length'=>'Please Enter More than 3 characters','max_length'=>'Please Enter Less than 50 characters')),
        'Email'             => new sfValidatorEmail(array('max_length' => 45, 'required' => $this->isNew()), array('required' => 'This field is required.', 'invalid' => 'Please enter valid Email Address','max_length'=>'E-mail address cannot be longer than 45 characters.')),
        'Password'          => new sfValidatorString(array('required' => true,'min_length' => 6), array('required' => 'This field is required.','min_length'=>'Password must be at least %min_length% characters long.')),
        'Confirm_Email'     => new sfValidatorEmail(array('max_length' => 45, 'required' => $this->isNew()), array('required' => 'This field is required.', 'invalid' => 'Please enter valid Email Address','max_length'=>'E-mail address cannot be longer than 45 characters.')),
        'Confirm_Password'  => new sfValidatorString(array('required' => false,'min_length' => 6), array('required' => 'This field is required.','min_length'=>'Password must be at least %min_length% characters long.')),
        'Address1'          => new sfValidatorString(array('required' => true), array('required' => 'This field is required.')),
        'Address2'          => new sfValidatorString(array('required' => false)),
        'Phone'             => new sfValidatorString(array('required' => true),array('required'=>"This field is required.")),
        'selectAll'         => new sfValidatorString(array('required' => false)),
        'Roles'             => new sfValidatorString(array('required' => true),array('required'=>'This field is required.'))
        ));

        //COMMENT : SET VALIDATOR SCHEMA FOR THE POST FORM VALIDAITON
        $this->validatorSchema->setPostValidator(new sfValidatorAnd( array(
        new sfValidatorDoctrineUnique(array( 'model' => 'Users', 'column' => 'Email', 'primary_key' => 'Id', 'required' => true, 'throw_global_error' => false ),array('invalid' => "Email already in use")),
        new sfValidatorDoctrineUnique(array( 'model' => 'Users', 'column' => 'Username', 'primary_key' => 'Id', 'required' => true, 'throw_global_error' => false ),array('invalid' => "User Name already in use"))
        )));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('admin_users[%s]');
        //$this->disableLocalCSRFProtection();
    }
}
?>
