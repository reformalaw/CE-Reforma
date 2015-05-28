<?php

class SearchForumForm extends sfForm {

    public function configure() {
        parent::configure();

        $this->setWidgets(array(
			'searchforum'          => new sfWidgetFormInputText()
        ));

        $this->widgetSchema->setLabels(array(
			'searchforum'	  => 'Search Forum: '
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search_topic[%s]');
    }
}
?>