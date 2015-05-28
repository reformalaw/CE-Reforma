<?php

class AdminLoginForm extends BaseUsersForm {

    public function configure() {
        parent::configure();

        unset(
        $this['id'],
        $this['role'],
        $this['plan_id'],
        $this['company_id'],
        $this['first_name'],
        $this['last_name'],
        $this['activation_code'],
        $this['continent_id'],
        $this['country_id'],
        $this['city_id'],
        $this['headline'],
        $this['image_name'],
        $this['tags'],
        $this['professional_summary'],
        $this['followers_count'],
        $this['connection_count'],
        $this['volenteers'],
        $this['volunteer_mentor'],
        $this['status'],
        $this['view_count'],
        $this['created_at'],
        $this['updated_at'],
        $this['sector_list']
        );


        $this->setWidgets(array(
        'email'             => 	new sfWidgetFormInputText(),
        #'password'         =>  new sfWidgetFormInputPassword(),
        'password'          =>  new sfWidgetFormInputText(),
        'remember'          => new sfWidgetFormInputCheckbox()
        ));

        $this->widgetSchema->setLabels(array(
        'email'           	=> 'Email',
        'password'  	    => 'Password',
        'remember'          => 'Remember Me'
        ));


        $this->setValidators(array(
        'email'             => new sfValidatorEmail(array('max_length' => 45, 'required' => true), array('required' => 'This field is required.', 'invalid' => 'Please enter valid e-mail address.','max_length'=>'E-mail address cannot be longer than 45 characters.')),
        'password'          => new sfValidatorString(array('required' => true,'min_length' => 6), array('required' => 'This field is required.','min_length'=>'Password must be at least %min_length% characters long.')),
        'RememberMe'        => new sfValidatorString(array('required' => false))
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('login[%s]');
        $this->disableLocalCSRFProtection();

    }
}
?>