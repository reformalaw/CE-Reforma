<?php

class LegalgripLoginForm extends BaseUsersForm {

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

        #$this->widgetSchema['email'] = new sfWidgetFormInputText();
        #$this->widgetSchema['password'] = new sfWidgetFormInputPassword();
        #$this->widgetSchema['remember'] = new sfWidgetFormInputCheckbox();
        /*$this->setWidgets(array(
        'email' => new sfWidgetFormInputText(),
        'password' => new sfWidgetFormInputPassword(),
        'remember' => new sfWidgetFormInputCheckbox()
        ));


        $this->widgetSchema->setLabels(
        array('email' => 'Username',
        'password' => 'Password',
        'remember' => 'Remember Me'
        ));

        $this->setValidators(array(
        'Email'        => new sfValidatorEmail(array('max_length' => 45, 'required' => true), array('required' => 'Please enter username.', 'invalid' => 'Please enter valid username.')),
        'Password'        => new sfValidatorString(array('required' => true), array('required' => 'Please enter password.')),
        'RememberMe'      => new sfValidatorString(array('required' => false))
        ));	*/
        $this->setWidgets(array(
        'email'             => 	new sfWidgetFormInputText(),
        'password'         =>  new sfWidgetFormInputPassword(),
        #'password'          =>  new sfWidgetFormInputText(),
        'remember'          => new sfWidgetFormInputCheckbox()
        ));

        $this->widgetSchema->setLabels(array(
        'email'           	=> 'Email',
        'password'  	    => 'Password',
        'remember'          => 'Remember Me'
        ));


        $this->setValidators(array(
        'email'             => new sfValidatorEmail(array('max_length' => 70, 'required' => true), array('required' => 'This field is required.', 'invalid' => 'Please enter valid e-mail address.','max_length'=>'E-mail address cannot be longer than 70 characters.')),
        'password'          => new sfValidatorString(array('required' => true,'min_length' => 6), array('required' => 'This field is required.','min_length'=>'Password must be atleast 6 characters long.')),
        'RememberMe'        => new sfValidatorString(array('required' => false))
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('login[%s]');
        $this->disableLocalCSRFProtection();

    }
}
?>