<?php

class SearchReviewRatingForm extends sfForm {

    public static $searchText = array('' => 'Select One','FirstName' => 'Name','Email' => 'Email');

    public function configure() {
        parent::configure();

		$userList = Doctrine_Query::create()->select('U.Id, U.FirstName, U.LastName')->from('Users U')->where('U.UserType = ?', "Customer")->andWhereIn('U.Status',array('Active','Inactive'))->fetchArray(); //->andWhere('U.NoOfRating > ?', 0)
		
		foreach($userList as $user)
		{
			$userNameList[$user['Id']] = $user['FirstName']." ".$user['LastName'];
		}

        $this->setWidgets(array(
        'searchcustomer'          	=> new sfWidgetFormSelect(array('choices' =>  array('0'=>'Select Customer')+$userNameList )),
        'searchspam'					=> new sfWidgetFormInputCheckbox()
        ));

        $this->widgetSchema->setLabels(array(
		'searchcustomer' => 'Select Customer :',
		'searchspam'		=> 'Marked As Spam :'

        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search_admin_case[%s]');
    }
}
?>