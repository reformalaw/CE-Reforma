<?php

class SearchAdminUsersCustomersForm extends BaseUsersForm {

    public static $searchText = array('FirstName' => 'Name','Email' => 'Email','BillingSubscription'=>'Billing','WebsiteSubscriotion'=>'Website','NetworkProfileSubscription'=>'Profile');
    public static $status = array('' => 'Select One','Yes' => 'Yes','No'=>'No');
    public function configure() {
        parent::configure();

        $this->setWidgets(array(
        'search_text'	        => new sfWidgetFormInputText(),
        'field_type'            => new sfWidgetFormSelect(array('choices'=>self::$searchText)),
        'status'                => new sfWidgetFormSelect(array('choices'=>self::$status)),
        ));

        $this->widgetSchema->setLabels(array(
        'search_text'	          => 'Keyword',
        'field_type'	          => 'Search option',
        'status'	              => 'Status',
        ));

        $this->setValidators(array(
        'search_text'               => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>50),array('required'=>'Please Enter First Name','min_length'=>'Please Enter More than 3 characters','max_length'=>'Please Enter Less than 50 characters')),
        'field_type'                => new sfValidatorChoice(array('required' => true,'choices'=>self::$searchText)),
        'status'                    => new sfValidatorChoice(array('required' => true,'choices'=>self::$status)),
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search_admin_users_customers[%s]');
    }
}
?>