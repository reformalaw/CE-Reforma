<?php

/**
 * Counties form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CountiesForm extends BaseCountiesForm
{
	public function configure()
	{
		unset(
        $this["id"],
        $this["UpdateDateTime"],
        $this["CreateDateTime"],
        $this["Status"]
        );

        if(!$this->isNew())
		{
			$Id        = $this->getOption('Id');
			$objCounties = Doctrine::getTable('Counties')->find(array($Id));
			
		}
		
        $this->setWidgets(array(
			'Id' 					=> new sfWidgetFormInputHidden(),
			'Name' 	=> new sfWidgetFormInputText(array(),array('style'=>'width:250px'))
        ));

			if($this->isNew())
			{
				$this->setWidget(
						'StateId'	, new sfWidgetFormDoctrineChoice(
						array(
						'model' 		=> $this->getRelatedModelName('CountiesStates'),
						'query' 		=>  Doctrine_Query::create()->select('s.Id, s.Name')->from('States s')->where('s.CountryId = ?', sfConfig::get('app_State_UsStateId') )->andWhere('s.Status = ?','Active'),
						'multiple' 	=> false,
						'add_empty'	=> 'Select State',
						'order_by' 	=> array('Name', 'asc')
						))
				);

			}
			else
			{
				$this->setWidget(
						'StateId'	, new sfWidgetFormDoctrineChoice(
						array(
						'model' 		=> $this->getRelatedModelName('CountiesStates'),
						'query' 		=>  Doctrine_Query::create()->select('s.Id, s.Name')->from('States s')->where('s.CountryId = ?', sfConfig::get('app_State_UsStateId') )->andWhere('s.Status = ?','Active')->andWhere('s.Id = ?', $objCounties->getStateId()),
						'multiple' 	=> false,
						'add_empty'	=> 'Select State',
						'order_by' 	=> array('Name', 'asc')
						))
				);
			}
			
        $this->widgetSchema->setLabels(array(
			'Name'   => 'County Name',
			'StateId' => 'State'
        ));

        $this->setValidators(array(
			'Id'             		=> new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
			'Name' => new sfValidatorString(array('max_length' => 256, 'required' => true),array('required'=>'Please enter a county name.')),
			'StateId'                       => new sfValidatorString(array('required' => true),array('required'=>'Please select your state.'))
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('counties[%s]');
	}
}
