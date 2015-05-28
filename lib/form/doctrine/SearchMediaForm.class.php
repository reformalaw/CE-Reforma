<?php

class SearchMediaForm extends BaseForumReplyForm {
    public static $searchType = array('BannerBackground' => 'Banner Background','BannerForeground' => 'Banner Foreground','Unsorted' => 'Unsorted', 'Logo'=>'Logo','BodyBackground' => 'Body Background');

    public function configure() {
        parent::configure();

        $this->setWidgets(array(
        'search_type' 	=> new sfWidgetFormSelect(array('choices'=>self::$searchType)),
        ));

        $this->widgetSchema->setLabels(array(
        'search_type'	=> 'Search By Type:',
        ));

        $this->setValidators(array(
        'search_type'        => new sfValidatorChoice(array('required' => true,'choices'=>self::$searchType)),
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('SearchMedia[%s]');
    }
}
?>