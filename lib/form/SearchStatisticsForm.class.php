<?php

class SearchStatisticsForm extends sfForm {


    public function configure() {
        parent::configure();

		$websiteLists = Doctrine_Query::create()->select('UW.Id, UW.WebsiteURL')->from('UsersWebsite UW')->where('UW.Status = ?', "Active")->whereNotIn('UW.Id',array(1,2))->fetchArray();
		
		foreach($websiteLists as $websiteList)
		{
			$websiteUrl[$websiteList['Id']] = $websiteList['Websiteurl'];
		}

        $this->setWidgets(array(
        'websiteStatistics'          	=> new sfWidgetFormSelect(array('choices' =>  array(''=>'Select Website')+$websiteUrl ))
        ));

        $this->widgetSchema->setLabels(array(
		'websiteStatistics' => 'Select Website :'
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search_statistics[%s]');
    }
}
?>