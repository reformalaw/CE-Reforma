<?php

class LGHeaderSearchForm extends sfForm  {

    public function configure() {
        parent::configure();

            
        #$stateArr = StatesTable::getUSStatesData(); // Get Us States
        $stateArr = UserPracticeAreaLocationTable::getLocationStates(); // Get Us States
        
        
        #$parentPracticeArr = PracticeAreasTable::getPracticeAreaCat(); // Get Parent Practice Areas
        $parentPracticeArr = PracticeAreasTable::getPracticeAreaCatWithSlug(); // Get Parent Practice Areas with slug => Name, only Used Parent Practice Area will come 
        
        $subPracticeArr = array();  // Get Sub Practice Areas
        $childPracticeArr = array(); // Get Child Practice Areas
        $sortArr = array('rating' => 'Rating' , 'name' => 'Name');

        $this->setWidgets(array(

        'DefaultState'          => new sfWidgetFormSelect(array('choices' =>  array( '0' => 'Select State') + $stateArr)),
        'DefaultCounty'         => new sfWidgetFormSelect(array('choices' =>  array( '0' => 'Select County') )),
        'BasicSearch'           => new sfWidgetFormInputText(),
        'ParentPracticeArea'    => new sfWidgetFormSelect(array('choices' =>  array( '0' => 'Select') + $parentPracticeArr)),
        'SubPracticeArea'       => new sfWidgetFormSelect(array('choices' =>  array( '0' => 'Select') + $subPracticeArr)),
        'ChildPracticeArea'     => new sfWidgetFormSelect(array('choices' =>  array( '0' => 'Select') + $childPracticeArr)),
        #'FreeConsultation'      => new sfWidgetFormInputCheckbox()
        'SortBy'                => new sfWidgetFormSelect(array('choices' =>  array( '0' => 'Select') + $sortArr))
        ));

        $this->widgetSchema->setLabels(array(
        'DefaultState'	        => 'Change Location',
        'DefaultCounty'	        => 'Select County',
        'BasicSearch'           => 'Basic Search',
        'ParentPracticeArea'    => 'Legal Professionals',
        #'FreeConsultation'     => 'Offer Free Consultation'
        'SortBy'                => 'Sort by'

        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('headersearch[%s]');
    }
}
?>