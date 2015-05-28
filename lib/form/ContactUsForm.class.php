<?php

class ContactUsForm extends sfForm {

    public function configure() {
        parent::configure();

        $this->setWidgets(array(
        'name'              =>  new sfWidgetFormInputText(),
        'email'             =>  new sfWidgetFormInputText(),
        'preferredEmail'    =>  new sfWidgetFormInputCheckbox(),
        'phone'             =>  new sfWidgetFormInputText(),
        'preferredPhone'    =>  new sfWidgetFormInputCheckbox(),
        'note'              =>  new sfWidgetFormTextarea()
        ));

        $this->setValidators(array(
        'name'              => new sfValidatorString(array('required'=>true,'min_length'=>3),array('required'=>'This field is required.','min_length'=>'Name must be at least %min_length% characters long.')),
        'email'             => new sfValidatorEmail(array('max_length' => 50, 'required' => true), array('required' => 'This field is required.', 'invalid' => 'Please enter valid e-mail address.','max_length'=>'E-mail address cannot be longer than 50 characters.')),
        'preferredEmail'    => new sfValidatorString(array('required'=>false)),
        'phone'             => new sfValidatorString(array('required' => true), array('required' => 'This field is required.')),
        'preferredPhone'    => new sfValidatorString(array('required'=>false)),
        'note'              => new sfValidatorString(array('required' => false))
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('contact_us[%s]');
        $this->disableLocalCSRFProtection();
    }
}
?>