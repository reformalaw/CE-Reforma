<?php

class AdminUsersCustomersForm extends BaseUsersForm {

    //public static $subscribe = array('3rd Party billing'=>'3rd Party billing','Personal website'=>'Personal website','Network Portal Profile'=>'Network Portal Profile');
    public function configure() {
        parent::configure();

        unset(
        $this['Id'],
        $this['ProfilePic'],
        $this['CountryId'],
        $this['ActivationCode'],
        //$this['Address1'],
        //$this['Address2'],
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

        if ($this->getOption("edit")) {
            echo $emailRequire = false;
        }

        //$query = PracticeAreasTable::getPracticeAreaParentList();
        $query2 = PracticeAreasTable::getPracticeAreaList();
        $this->setWidgets(array(
        'FirstName'                    =>  new sfWidgetFormInputText(),
        'LastName'                     =>  new sfWidgetFormInputText(),
       // 'Username'                     =>  new sfWidgetFormInputText(),
        'Email'                        =>  new sfWidgetFormInputText(),
        'Password'                     =>  new sfWidgetFormInputPassword(),
        'Confirm_Email'                =>  new sfWidgetFormInputText(),
        'Confirm_Password'             =>  new sfWidgetFormInputPassword(),
        //'Subscribe'                  =>  new sfWidgetFormChoice(array('choices'=>self::$subscribe,'expanded'=>true,'multiple'=>true)),
        'BillingSubscription'          => new sfWidgetFormInputCheckbox(),
        'WebsiteSubscriotion'          => new sfWidgetFormInputCheckbox(),
        'NetworkProfileSubscription'   => new sfWidgetFormInputCheckbox(),
        'Weburl'                       =>  new sfWidgetFormInputText(),
        'Address1'                     =>  new sfWidgetFormInputText(),
        'Address2'                     =>  new sfWidgetFormInputText(),
        'City'                         =>  new sfWidgetFormInputText(),
        'StateId'                      =>  new sfWidgetFormDoctrineChoice(
        //array('model'=>$this->getRelatedModelName('UsersStates'),'add_empty'=>'Select State')
        array(
        'model' 		=> $this->getRelatedModelName('UsersStates'),
        'query' 		=>  Doctrine_Query::create()->select('s.Id, s.Name')->from('States s')->where('s.CountryId = ?', sfConfig::get('app_State_UsStateId') )->andWhere('s.Status = ?','Active'),
        'multiple' 	=> false,
        'add_empty'	=> 'Select State',
        'order_by' 	=> array('Name', 'asc')
        )
        ),
        'Zip'                         =>  new sfWidgetFormInputText(),
        'Phone'						=>  new sfWidgetFormInputText(),
        //'Network'                    =>  new sfWidgetFormChoice(array('choices'=>$query,'multiple'=>true),array('style'=>'width:200px;height:200px;'))
        'Network'                      =>  new myTreeWidgetFormCheckboxes(array('choices' => $query2,'treeid'=>'treeNetworkProfile','class'=>'checkboxTree')),
        'PriorityListing'			=> new sfWidgetFormChoice( array('choices'=>array("Yes" =>"Yes","No"=>"No"),'expanded'=>true ) )
        ));

        $this->widgetSchema->setLabels(array(
        'FirstName'                 => 'First Name ',
        'LastName'                  => 'Last Name ',
       // 'Username'                  => 'User Name ',
        'Email'                     => 'Email ',
        'Password'                  => 'Password ',
        'Confirm_Email'                     => 'Confirm Email ',
        'Confirm_Password'                  => 'Confirm Password ',
        'BillingSubscription'       =>'Billing Subscription ',
        'WebsiteSubscriotion'       =>'Website Subscription ',
        'NetworkProfileSubscription'=>'NetworkProfile Subscription ',
        //'Subscribe'         => 'Subscribe For ',
        'Weburl'                    => 'Web URL ',
        'Address1'                  => 'Address 1 ',
        'Address2'                  => 'Address 2 ',
        'City'                      => 'City ',
        'StateId'                   => 'State ',
        'Zip'                       => 'Zip Code ',
        'Phone'						=> 'Phone',
        'Network'                   => 'NetworkProfile ',
        'PriorityListing'			=> 'Priority Listing'
        ));


        $this->setValidators(array(
        'FirstName'                     => new sfValidatorString(array('required' => true,'min_length' => 2,'max_length'=>45),array('required'=>'This field is required.','min_length'=>'First name  must be at least 2 characters long.','max_length'=>'First name cannot be longer than 45 characters.')),
        'LastName'                      => new sfValidatorString(array('required' => true,'min_length' => 2,'max_length'=>45),array('required'=>'This field is required.','min_length'=>'Last  name  must be at least 2 characters long.','max_length'=>'Last name cannot be longer than 45 characters.')),
       // 'Username'                      => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>50),array('required'=>'Please Enter User Name','min_length'=>'Please Enter More than 3 characters','max_length'=>'Please Enter Less than 50 characters')),
        'Email'                         => new sfValidatorEmail(array('max_length' => 70, 'required' => true), array('required' => 'This field is required.', 'invalid' => 'Please enter valid e-mail address.','max_length'=>'E-mail address cannot be longer than 70 characters.')),
        'Password'                      => new sfValidatorString(array('required' => false,'min_length' => 6), array('required' => 'This field is required.','min_length'=>'Password must be atleast 6 characters long')),
        'Confirm_Email'                 => new sfValidatorEmail(array('max_length' => 70, 'required' => false), array('required' => 'This field is required.', 'invalid' => 'Please enter valid e-mail address.','max_length'=>'E-mail address cannot be longer than 70 characters.')),
        'Confirm_Password'              => new sfValidatorString(array('required' => false,'min_length' => 6), array('required' => 'This field is required.','min_length'=>'Password must be atleast 6 characters long')),
        'BillingSubscription'           => new sfValidatorBoolean(array('required' => false)),
        'WebsiteSubscriotion'           => new sfValidatorBoolean(array('required' => false)),
        'NetworkProfileSubscription'    => new sfValidatorBoolean(array('required' => false)),
        //'Subscribe'                   => new sfValidatorString(array('required' => true)),
        'Weburl'                        => new sfValidatorString(array('required' => false)),
        'Address1'                      => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>150),array('required'=>'This field is required.','min_length'=>'Address 1 field must be at least 3 characters long.','max_length'=>'Address 1 cannot be longer than 45 characters.')),
        'Address2'                      => new sfValidatorString(array('required' => false,'min_length' => 3,'max_length'=>150),array('required'=>'This field is required.','min_length'=>'Address 2 field must be at least 3 characters long.','max_length'=>'Address 2 cannot be longer than 45 characters.')),
        'City'                          => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>45),array('required'=>'This field is required.','min_length'=>'City must be atleast 3 characters long','max_length'=>'City cannot be longer than 45 characters.')),
        'StateId'                       => new sfValidatorString(array('required' => true),array('required'=>'This field is required.')),
        'Zip'                           => new sfValidatorNumber(array('required' => false)),
        'Phone'                         => new sfValidatorString(array('required' => true)),
        'Network'                       => new sfValidatorString(array('required' => false)),
        'PriorityListing'				=> new sfValidatorChoice(array('choices'=>array_keys(array("Yes" => "Yes","No" => "No")), 'multiple' => false, 'required'=>false))
        ));

        //COMMENT : SET VALIDATOR SCHEMA FOR THE POST FORM VALIDAITON

        if ($this->getOption("edit")) {
            $this->validatorSchema->setPostValidator(new sfValidatorAnd( ));
        }else {
            $this->validatorSchema->setPostValidator(new sfValidatorAnd( array(
            new sfValidatorDoctrineUnique(array( 'model' => 'Users', 'column' => 'Email', 'primary_key' => 'Id', 'required' => true, 'throw_global_error' => false ),array('invalid' => "Email is already in use")),
            new sfValidatorDoctrineUnique(array( 'model' => 'Users', 'column' => 'UserName', 'primary_key' => 'Id', 'required' => true, 'throw_global_error' => false ),array('invalid' => "User Name is already in use")),
            new sfValidatorDoctrineUnique(array( 'model' => 'UsersWebsite', 'column' => 'WebsiteURL', 'primary_key' => 'Id', 'required' => true, 'throw_global_error' => false ),array('invalid' => "Web URL is already in use"))
            )));
        }


        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('admin_users_customers[%s]');
    }
}
?>