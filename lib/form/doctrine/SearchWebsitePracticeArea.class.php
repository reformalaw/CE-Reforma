<?php

class SearchWebsitePracticeArea extends BaseForumReplyForm {

    public function configure() {
        parent::configure();

//         $searchText = array(	""=> "Select",
// 						sfConfig::get("app_WebsitePrecticeType_Left") 	=> sfConfig::get("app_WebsitePrecticeType_Left"),
// 						sfConfig::get("app_WebsitePrecticeType_Page") 	=> sfConfig::get("app_WebsitePrecticeType_Page"),
// 						sfConfig::get("app_WebsitePrecticeType_Right")	=> sfConfig::get("app_WebsitePrecticeType_Right")
// 					);
		$searchText =  array(""=> "Select", 'column1'=> sfConfig::get("app_WebsitePracticeAreaTemplate_Column1"),'column2L'=> sfConfig::get("app_WebsitePracticeAreaTemplate_Column2L"), 'column2R'=> sfConfig::get("app_WebsitePracticeAreaTemplate_Column2R"));
					
        $this->setWidgets(array(
        'search_text' 	=> new sfWidgetFormSelect(array('choices'=>$searchText),array("style"=>"width:110px;")),
        ));

        $this->widgetSchema->setLabels(array(
        'search_text'	=> 'Select Template',
        ));

        $this->setValidators(array(
        'search_text'        => new sfValidatorChoice(array('required' => true,'choices'=>$searchText)),
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('SearchWebsitePracticeArea[%s]');
    }
}
?>