<?php

class TopicSearchForm extends sfForm {

    public function configure() {
        parent::configure();

        $searchArray  = array(
        '' => 'Select',
        "LastRepliedDateTime" => "Recently Replied",
        "CreateDateTime"=>"Start Date",
        "TotalReplies"=>"Most Replied",
        "TotalViews"=> "Most Viewed"
        );


        $this->setWidgets(array(
        'topicAttribute'          => new sfWidgetFormSelect(array('choices' =>  $searchArray )),
        'searchtopic'          => new sfWidgetFormInputText()
        ));

        $this->widgetSchema->setLabels(array(
        'topicAttribute'	  => 'Sort by: ',
        'searchtopic'	  => 'Search Topic: '
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search_topic[%s]');
    }
}
?>