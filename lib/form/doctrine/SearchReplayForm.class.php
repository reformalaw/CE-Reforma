<?php

class SearchReplayForm extends BaseForumReplyForm {
    public static $searchText = array('' => 'Select One','Title' => 'Forum','Topic' => 'Topic');
    public function configure() {
        parent::configure();

        $this->setWidgets(array(
        //'search_text'	=> new sfWidgetFormInputText(),
        //'field_type'    => new sfWidgetFormSelect(array('choices'=>self::$searchText))
        'field_type'    =>  new sfWidgetFormDoctrineChoice(array(
												'model' 		=> 'UsersWebsite',
												'query' 		=>  Doctrine_Query::create()->select('f.Id, f.WebsiteURL')->from('UsersWebsite f')->whereNotIn('f.id ', array(0,1,2) ),
												'multiple' 	=> false,
												'add_empty' 	=> 'Select',
												'order_by' 	=> array('WebsiteURL', 'asc')
											),array("style"=>"width:260px")),
        ));

        $this->widgetSchema->setLabels(array(
        //'search_text'	  => 'Keyword',
        'field_type'	  => 'Select Website'
        ));

        $this->setValidators(array(
        //'search_text'       => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>50),array('required'=>'Please Enter First Name','min_length'=>'Please Enter More than 3 characters','max_length'=>'Please Enter Less than 50 characters')),
        //'field_type'        => new sfValidatorChoice(array('required' => true,'choices'=>self::$searchText)),
        'field_type'        => new sfValidatorDoctrineChoice(array('model' => 'UsersWebsite', 'column' => 'Id', 'multiple' => false),array('required'=>"Please select forum")),
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search_replay[%s]');
    }
}
?>