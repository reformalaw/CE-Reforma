<?php

/**
 * Media form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MediaForm extends BaseMediaForm
{
	public function configure()
	{
		if(!$this->isNew())
			$stockPhotoType     = array($this->getOption('bannerType')=>$this->getOption('bannerType'));
		else
			$stockPhotoType = array(""=>"Select", "BannerBackground"=>"Banner Background", "BannerForeground"=>"Banner Foreground", "Unsorted"=>"Unsorted", "Logo"=>"Logo", "BodyBackground"=>"Body Background");

		unset( $this["UpdateDateTime"],$this["CreateDateTime"],$this["OrgName"] );

		$this->setWidgets(array(
								'Id' 		=> new sfWidgetFormInputHidden(),
								'Title' 		=> new sfWidgetFormInputText(array(),array('style'=>'width:310px')),
								'ImageName' 	=> new sfWidgetFormInputFile(),
								'Type'      => new sfWidgetFormChoice(array('choices' => $stockPhotoType))
						));

		$this->widgetSchema->setLabels(array(
										'Title' 		=> "Title",
										'ImageName' => "Image",
										'Type'      => "Stock Photo Type"
									));

		$this->setValidators(array(
								'Id'        	=> new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
								'Title' 		=> new sfValidatorString(array('max_length' => 30, 'required' => true),array('required'=>'This field is required.')),
								'ImageName' => new sfValidatorFile(array('required' => true,'required'=>$this->isNew()),array('required' => 'This field is required.')),
								'Type'      => new sfValidatorString(array('required' => true),array('required'=>'This field is required.'))
							));

		$this->validatorSchema->setPostValidator(
									new sfValidatorAnd(array(
                                              new sfValidatorDoctrineUnique(array(
																'model' 					=> 'Media',
																'column' 				=> 'Title',
																'primary_key' 			=> 'Id',
																'required' 			 	=> true,
																'throw_global_error' 	=> false
															),
															array('invalid' =>"Title already in use, please try again.")
											))));

	$this->validatorSchema->setOption('allow_extra_fields', true);
	$this->widgetSchema->setNameFormat('Media[%s]');

	}
}