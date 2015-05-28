<?php

/**
 * BannerBackground form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BannerBackgroundForm extends BaseThemeOptionsForm
{
	public function configure()
	{
		unset(
        $this["ThemeId"],
        $this["WebsiteId"],
        $this["OptionKey"],
        $this["CreateDateTime"],
        $this["UpdateDateTime"]
        );

		$this->setWidgets(array(
								'Id' 		=> new sfWidgetFormInputHidden(),
								'OptionValue' 	=> new sfWidgetFormInputFile(),
								'StockPhotoChoice'	=> new sfWidgetFormChoice( array('choices'=>array("From Stock Photo","Your Own Image"),'expanded'=>true ) )
						));

		$this->widgetSchema->setLabels(array(
										'OptionValue' => "Background Image",
										"StockPhotoChoice" => "Select Background"
									));

		$this->setValidators(array(
								'Id'        	=> new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
								'OptionValue' => new sfValidatorFile(array('required' => true,'required'=>$this->isNew()),array('required' => 'Please provide image')),
								'StockPhotoChoice'	=> new sfValidatorChoice(array('choices'=>array_keys(array("From Stock Photo","Your Own Image")),'multiple' => false), array('required'=>"Please Select Custom or Stock Photo"))
							));

	$this->validatorSchema->setOption('allow_extra_fields', true);
	$this->widgetSchema->setNameFormat('BannerBackground[%s]');
	}
}