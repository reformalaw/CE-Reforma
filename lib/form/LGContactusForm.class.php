<?php

class LGContactusForm extends sfForm {

    public function configure() {
        parent::configure();

        $this->setWidgets(array(
        'name'              =>  new sfWidgetFormInputText(),
        'email'             =>  new sfWidgetFormInputText(),
        'phone'             =>  new sfWidgetFormInputText(),
        'message'           =>  new sfWidgetFormTextarea()
        ));

        $this->widgetSchema->setLabels(array(
        'name'		=> 'Name',
        'email'		=> 'Email',
        'phone'		=> 'Phone',
        'message' 	=> 'Add a Note'
        ));

        $this->setValidators(array(
        'name'              => new sfValidatorString(array('required'=>true),array('required'=>'Please provide your name')),
        'email'             => new sfValidatorEmail(array('required' => true), array('required' => 'Please enter Email Address', 'invalid' => 'Please enter valid Email Address')),
        'phone'             => new sfValidatorString(array('required' => true), array('required' => 'Please provide your phone number')),
        'message'           => new sfValidatorString(array('required' => true), array('required' => 'Please provide your note'))
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('contact[%s]');
        $this->disableLocalCSRFProtection();
    }
}
?>