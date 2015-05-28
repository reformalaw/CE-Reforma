<?php

/**
 * States form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StatesForm extends BaseStatesForm
{
	public function configure()
	{
		unset(
        $this["id"],
        $this["UpdateDateTime"],
        $this["CreateDateTime"],
        $this["CountryId"],
        $this["Status"]
        );

        $this->setWidgets(array(
			'Id' 					=> new sfWidgetFormInputHidden(),
			'Name' 	=> new sfWidgetFormInputText(array(),array('style'=>'width:250px'))
        ));

        $this->widgetSchema->setLabels(array(
			'Name'   => 'State Name'
        ));

        $this->setValidators(array(
			'Id'             		=> new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
			'Name' => new sfValidatorString(array('max_length' => 256, 'required' => true),array('required'=>'This field is required.'))
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('states[%s]');
	}
}
