<?php

class ForgotForm extends BaseUsersForm {

    public function configure() {
        parent::configure();

        unset(
        $this['Id'],
        $this['role'],
        $this['Username'],
        $this['FirstName'],
        $this['LastName'],
        $this['ProfilePic'],
        $this['Address1'],
        $this['Address2'],
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
        $this['password']
        );

        
        $this->setWidgets(array(
        'email'             => 	new sfWidgetFormInputText(),
        //'password'          =>  new sfWidgetFormInputPassword(),
        ));

        $this->widgetSchema->setLabels(array(
        'email'           	=> 'Email :',
        //'password'  	    => 'Password',
        ));


        $this->setValidators(array(
        'email'             => new sfValidatorEmail(array('max_length' => 70, 'required' => true), array('required' => 'This field is required.', 'invalid' => 'Please enter valid e-mail address.','max_length'=>'E-mail cannot be longer than 45 characters.')),
        //'password'      => new sfValidatorString(array('required' => true,'min_length' => 5), array('required' => 'Please enter Password','min_length'=>'Password must be at least %min_length% characters long')),
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('forgot[%s]');
        //$this->disableLocalCSRFProtection();
    }
}
?>
