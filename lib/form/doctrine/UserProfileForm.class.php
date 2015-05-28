<?php

/**
 * UserProfile form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserProfileForm extends BaseUserProfileForm
{
    public function configure()
    {
        parent::configure();

        unset(
        $this['Id'],
        $this['UserId']
        );

        $query2 = PracticeAreasTable::getPracticeAreaList(); // Get All Practice Area List

        $stateQuery = StatesTable::getStateList(); // Get All State List with Counties
        $this->setWidgets(array(
        'FirmName'         		 =>	new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
        'Address1'          	 =>	new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
        'Address2'          	 =>	new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
        'City'                   =>	new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
        'StateId'                =>  new sfWidgetFormDoctrineChoice(
        array(
        'model' 		          => $this->getRelatedModelName('UserProfileStates'),
        'query' 		          =>  Doctrine_Query::create()->select('s.Id, s.Name')->from('States s')->where('s.CountryId = ?', sfConfig::get('app_State_UsStateId') )->andWhere('s.Status = ?','Active'),
        'multiple' 	=> false,
        'add_empty'	=> 'Select State',
        'order_by' 	=> array('Name', 'asc')
        ),array('style'=>'width:300px')
        ),
        'Zip'                   => new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
        'Phone'              	=> new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
        //'Summary'            	=> new sfWidgetFormTextarea(array(),array('cols'=>10,'rows'=>3, 'style'=>'width:300px')),
        'Summary'				=> new sfWidgetFormFCKEditor(array('rows'=>40)),
       # 'FeesInformation'    	=> new sfWidgetFormInputText(array(),array('style'=>'width:300px')),
        'FeesInformation'    	=> new sfWidgetFormTextarea(array(),array('rows'=>8,'cols'=>80)),
        'FreeConsultation'   	=> new sfWidgetFormInputCheckbox(),
        'Network'               => new myTreeWidgetFormCheckboxes(array('choices' => $query2,'treeid'=>'treeNetworkProfile','class'=>'checkboxTree')),
        'Location'              => new myTreeWidgetFormCheckboxes(array('choices' => $stateQuery,'treeid'=>'treeNetworkLocation','class'=>'checkboxTree'))
        ));

        $this->widgetSchema->setLabels(array(
        'FirmName'         		=> 'Firm Name',
        'Address1'          	=> 'Address 1 ',
        'Address2'          	=> 'Address 2 ',
        'City'              	=> 'City ',
        'StateId'           	=> 'State ',
        'Zip'               	=> 'Zip Code ',
        'Phone'            		=> 'Phone',
        'Summary'         		=> 'Summary / Bio-data',
        'FeesInformation' 		=> 'Fees Information',
        'FreeConsultation' 		=> 'Free Consultation',
        'Network'               => 'Practice Areas',
        'Location'               => 'Practice Area Location'
        ));

        $this->setValidators(array(
        'FirmName'         		=> new sfValidatorString(array('required' => false)), //,array('required'=>'This field is required.')
        'Address1'          	=> new sfValidatorString(array('required' => true), array('required' => 'This field is required.')),
        'Address2'          	=> new sfValidatorString(array('required' => false)),
        'City'              	=> new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>45),array('required'=>'This field is required.','min_length'=>'City must be at least 3 characters long. ','max_length'=>'City name cannot be longer than 45 characters.')),
        'StateId'           	=> new sfValidatorString(array('required' => true),array('required'=>'This field is required.')),
        'Zip'               	=> new sfValidatorNumber(array('required' => false)),
        'Phone'					=> new sfValidatorString(array('required' => true),array('required'=>'This field is required.')),
        //'Summary' 			=> new sfValidatorString(array('required' => true),array('required'=>'Please enter Summary')),
        'Summary'           	=> new sfValidatorString(array('required' => true),array('required'=>'This field is required.')),
        'FeesInformation'  		=> new sfValidatorString(array('required' => true), array('required' => 'This field is required.')),
        'FreeConsultation' 		=> new sfValidatorBoolean(array('required' => false)),
        'Network'               => new sfValidatorString(array('required' => true), array('required' => 'At least 1 practice area should be selected.')),
        'Location'              => new sfValidatorString(array('required' => true), array('required' => 'At least 1 practice area location should be selected.'))
        #'Network'               => new sfValidatorString(array('required' => false))
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('networkprofile[%s]');
    }
}