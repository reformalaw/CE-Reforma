<?php

/**
 * ThemeBanner form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ThemeBannerForm extends BaseThemeBannerForm
{
	public function configure()
	{
		$totalBannerTitle = $this->getOption('totlaBannerTitle');
		unset( $this["UpdateDateTime"],$this["CreateDateTime"] );

		$bannerTitle = array();
		for($i=1;$i<=$totalBannerTitle;$i++)
		{
			$bannerTitle['Title'.$i] =   new sfWidgetFormInputText(array(),array('style'=>'width:310px'));
		}
		

		$bannerField = array( 	'Id' 				=> new sfWidgetFormInputHidden(),
								'BannerName'			=> new sfWidgetFormInputText(array(),array('style'=>'width:310px')),
								'Image' 				=> new sfWidgetFormInputFile(),
								'StockPhotoChoice'	=> new sfWidgetFormChoice( array('choices'=>array("From Stock Photo","Your Own Image"),'expanded'=>true ) ));
								//'StockPhotoChoice'	=> new sfWidgetFormChoice(array('choices'=>array("Stock Photo","Custom"), 'expanded'=>true) , array('name'=>"stockData[]")));
								
		$bannerTotalField = array_merge($bannerField,$bannerTitle);
		$this->setWidgets($bannerTotalField
						);

		$this->widgetSchema->setLabels(array(
										'Title1' 	=> "Title1",
										'Image' 		=> "Image",
										"BannerName" => "Banner Name",
										"StockPhotoChoice" => "Select Banner Image"
									));

		$bannerTitleValidator = array();
		for($i=1;$i<=$totalBannerTitle;$i++)
		{
			$bannerTitleValidator['Title'.$i] =   new sfValidatorString(array('max_length' => 150, 'required' => false));
		}
		
		$bannerFieldValidator = array(
								'Id'        			=> new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
								'BannerName' 		=> new sfValidatorString(array('max_length' => 150, 'required' => true),array('required' => 'This field is required.')),
								'Image' 				=> new sfValidatorFile(array('required' => false),array('required' => 'This field is required.')),
								'StockPhotoChoice'	=> new sfValidatorChoice(
        array('choices'=>array_keys(array("From Stock Photo","Your Own Image")),'multiple' => false, 'required'=>$this->isNew()),  
        array('required'=>"Please select your own image or stock photo.")
        ),
								//'StockPhotoChoice'	=> new sfValidatorChoice(array('required'=>false, 'choices'=>array("Stock Photo","Custom") ),array('required'=> "Please Select Custom or Stock Photo"))
								);

		$bannerTotalFieldValidator = array_merge($bannerFieldValidator,$bannerTitleValidator);
		$this->setValidators(
							$bannerTotalFieldValidator
		/*array(
								'Id'        		=> new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
								'BannerName' 		=> new sfValidatorString(array('max_length' => 150, 'required' => true),array('required' => 'Please enter banner name')),
								'Title1' 		=> new sfValidatorString(array('max_length' => 150, 'required' => false)),
								'Title2' 		=> new sfValidatorString(array('max_length' => 150, 'required' => false)),
								'Title3' 		=> new sfValidatorString(array('max_length' => 150, 'required' => false)),
								'Image' 			=> new sfValidatorFile(array('required' => true,'required'=>$this->isNew()),array('required' => 'Please provide image')),
// 								'ThemeId' 		=> new sfValidatorDoctrineChoice(array('model' => 'Theme', 'column' => 'Id', 'multiple' => false),array('required'=>"Please select theme")),
							)*/
							);

		$this->validatorSchema->setOption('allow_extra_fields', true);
		$this->widgetSchema->setNameFormat('ThemeBanner[%s]');
	}
}