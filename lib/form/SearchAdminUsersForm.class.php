<?php

class SearchAdminUsersForm extends BaseUsersForm {
    public static $searchText = array('' => 'Select One','FirstName' => 'Name','Email' => 'Email');
    public function configure() {
        parent::configure();

        $this->setWidgets(array(
        'search_text'	=> new sfWidgetFormInputText(),
        'field_type'    => new sfWidgetFormSelect(array('choices'=>self::$searchText))
        ));

        $this->widgetSchema->setLabels(array(
        'search_text'	  => 'Keyword',
        'field_type'	  => 'Search option'
        ));

        $this->setValidators(array(
        'search_text'       => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>50),array('required'=>'Please Enter First Name','min_length'=>'Please Enter More than 3 characters','max_length'=>'Please Enter Less than 50 characters')),
        'field_type'        => new sfValidatorChoice(array('required' => true,'choices'=>self::$searchText)),
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search_admin_users[%s]');
    }
}
?>