<?php

class SearchCountiesForm extends sfForm {


    public function configure() {
        parent::configure();

		$statesList = Doctrine_Query::create()->select('S.Id, S.Name')->from('States S')->where('S.CountryId = ?', sfConfig::get('app_State_UsStateId'))->andWhere('S.Status = ?', sfConfig::get('app_UserStatus_Active'))->fetchArray();
		
		foreach($statesList as $stateList)
		{
			$stateNameList[$stateList['Id']] = $stateList['Name'];
		}

        $this->setWidgets(array(
        'searchbystate'          	=> new sfWidgetFormSelect(array('choices' =>  array('0'=>'Select State')+$stateNameList ))
        ));

        $this->widgetSchema->setLabels(array(
		'searchbystate' => 'Select State :',

        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search_counties[%s]');
    }
}
?>