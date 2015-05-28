<?php

class SearchUserWebsiteForm extends BaseForumReplyForm {
    public static $searchText = array('' => 'Select One','WebsiteURL' => 'Website','Status' => 'Status');
    public static $searchStatus = array('' => 'Select One', "Inactive" => "Inactive", "Active" => "Active");
    public function configure() {
        parent::configure();

        $this->setWidgets(array(
        'search_text'	=> new sfWidgetFormInputText(),
        'search_status' 	=> new sfWidgetFormSelect(array('choices'=>self::$searchStatus)),
        'field_type'    	=> new sfWidgetFormSelect(array('choices'=>self::$searchText))
        ));

        $this->widgetSchema->setLabels(array(
        'search_text'	=> 'Keyword',
        'search_status'	=> 'Keyword',
        'field_type'	  	=> 'Search'
        ));

        $this->setValidators(array(
        'search_text'       => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>50),array('required'=>'Please Enter First Name','min_length'=>'Please Enter More than 3 characters','max_length'=>'Please Enter Less than 50 characters')),
        'search_status'        => new sfValidatorChoice(array('required' => true,'choices'=>self::$searchStatus)),
        'field_type'        => new sfValidatorChoice(array('required' => true,'choices'=>self::$searchText)),
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('SearchUserWebsite[%s]');
    }
}
?>