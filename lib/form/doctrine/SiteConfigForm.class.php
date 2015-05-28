<?php

/**
 * SiteConfig form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SiteConfigForm extends BaseSiteConfigForm
{
	public function configure()
	{
		unset(
			  $this["UpdateDateTime"],
			  $this["CreateDateTime"]
		  );

		$this->setWidgets(array(
		'ConfigKey' => new sfWidgetFormInputHidden(),
		'ConfigValue'     	=> new sfWidgetFormTextarea(array(),array('cols'=>30,'rows'=>4)),
		));

		$this->widgetSchema->setLabels(array(
			'ConfigKey'		=> 'Key',
			'ConfigValue' 	=> 'Value'
		));

		$this->setValidators(array(
			'ConfigKey'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('ConfigKey')), 'empty_value' => $this->getObject()->get('ConfigKey'), 'required' => false)),
			'ConfigValue'     => new sfValidatorString(array('required' => true),array('required'=>'This field is required.')),
		));

		$this->validatorSchema->setOption('allow_extra_fields', true);
		$this->widgetSchema->setNameFormat('SiteConfig[%s]');
	}
}
