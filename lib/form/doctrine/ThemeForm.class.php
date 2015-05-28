<?php

/**
 * Theme form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ThemeForm extends BaseThemeForm
{
    public function configure()
    {
		$asTextWidget = array("" 	=> "Select",);
		for($i=1;$i<=sfConfig::get("app_TextWidget_NumberOfTextWedget");$i++)
		{
			$asTextWidget[$i] = $i;
		}

		$bannerTitle = array(""=>"Select",);
		for($j = 0;$j<=sfConfig::get("app_BannerTitle_NumberOfBannerTitle"); $j++)
		{
			$bannerTitle[$j] = $j;
		}

        parent::setup();
        unset(
        $this['IsDefault'],
        $this['status'],
        $this['CreateDateTime'],
        $this['UpdateDateTime'],
        $this["UniqueName"]
        );
        /* Image type */
        $this->Imagetype = array(
                        'image/jpeg',
                        'image/png',
                        'image/gif',
                        'image/pjpeg');

        $this->setWidgets(array(
        'Id'             		=> new sfWidgetFormInputHidden(),
        'Name'           		=> new sfWidgetFormInputText(),
//         'UniqueName'     		=> new sfWidgetFormInputText(),
        'ScreenShot'     		=> new sfWidgetFormInputFileEditable(
										array(
											'file_src' => sfConfig::get('app_ThumbnailPath_Thumbpath').$this->getObject()->getScreenShot(),
											'is_image' => true,
											'edit_mode' => !$this->isNew(),
											'with_delete' => false,
											)
										),
        'Features'       				=> new sfWidgetFormTextarea(array(),array('cols'=>40,'rows'=>10)),
        'ManageTopMenu'					=> new sfWidgetFormInputCheckbox(),
        'ManageFooterMenu'				=> new sfWidgetFormInputCheckbox(),
        'ManageBanner'  					=> new sfWidgetFormInputCheckbox(),
        'ManageColorAndBackground'		=> new sfWidgetFormInputCheckbox(),
        'ManageSocialMedia'				=> new sfWidgetFormInputCheckbox(),
        'ChangeLogo'						=> new sfWidgetFormInputCheckbox(),
        'ManageFAQs'						=> new sfWidgetFormInputCheckbox(),
        'BGColor'						=> new sfWidgetFormInputCheckbox(),
        'TextColor'						=> new sfWidgetFormInputCheckbox(),
        'BorderColor'					=> new sfWidgetFormInputCheckbox(),
        "BGcolorPicker"					=> new dcWidgetFormColorPicker(),
        "TextcolorPicker"				=> new dcWidgetFormColorPicker(),
        "BordercolorPicker"				=> new dcWidgetFormColorPicker(),
        'TextWidgets'					=> new sfWidgetFormInputCheckbox(),
        "TextWidgetCombo"    		    => new sfWidgetFormSelect(array('choices'=>$asTextWidget)),
        'LinkColor'						=> new sfWidgetFormInputCheckbox(),
        "LinkcolorPicker"				=> new dcWidgetFormColorPicker(),
        'LinkHoverColor'					=> new sfWidgetFormInputCheckbox(),
        "LinkHoverColorPicker"			=> new dcWidgetFormColorPicker(),
        "BannerTitleCombo"    		    => new sfWidgetFormSelect(array('choices'=>$bannerTitle)),
        'BannerBackground'				=> new sfWidgetFormInputCheckbox(),
        'BodyBackground'					=> new sfWidgetFormInputCheckbox()

        ));

        $this->widgetSchema->setLabels(array(
        'Id'          				=> 'Id',
        'Name'       	 			=> 'Name',
//         'UniqueName'  				=> 'Unique Name',
        'Features'    				=> 'Features',
        'ScreenShot'  				=> 'Screen Shot',
        'IsDefault'   				=> 'IsDefault',
        'ManageTopMenu'				=> 'Manage Top Menu',
        'ManageFooterMenu'			=> 'Manage Footer Menu',
        'ManageBanner'				=> 'Manage Banner',
        'ManageColorAndBackground'	=> 'Manage Color & Background',
        'ManageSocialMedia'			=> 'Manage Social Media',
        'ChangeLogo' 				=> 'Change Logo',
        'ManageFAQs' 				=> 'Manage FAQs',
        'BGColor' 					=> 'Background Color',
        'TextColor' 					=> 'Text Color',
        'BorderColor' 				=> 'Border Color',
        'TextWidgets'					=> 'Text Widgets',
		'TextWidgetCombo'           	=> 'Select No - Text Widgets',
		'LinkColor'					=> 'Link Color',
		'LinkHoverColor'				=> 'Link Hover Color',
		'BannerTitleCombo'          	=> 'Select No - Banner Title',
		'BannerBackground'			=> 'Banner Background',
		'BodyBackground'				=> 'Body Background'
        ));

        $this->setValidators(array(
        'Id'             			=> new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
       // 'Name'           			=> new sfValidatorString(array('max_length' => 50 , 'required'=>true),array('required'=>'Please enter name','max_length' => 'Name cannot be longer than 50 characters.')),
		'Name'						=> new sfValidatorAnd(array(
										new sfValidatorString(
                                                 array('required' => true, 'max_length' => 50),
                                                 array( 'max_length' => 'Name cannot be longer than 50 characters.')
                                                ),
												new sfValidatorRegex(
														array('pattern' => '/^[A-z a-z 0-9]*$/i'),
														array('invalid' => 'Name can only have letters (A-Z) or (a-z).')
														),
													),
												array(),
												array('required' => 'This field is required.')),
//         'UniqueName'     			=> new sfValidatorAnd(array(
// 										new sfValidatorString(
//                                                  array('required' => true, 'max_length' => 150),
//                                                  array( 'max_length' => 'Your username cannot be longer than 150 characters.')
//                                                 ),
// 												new sfValidatorRegex(
// 														array('pattern' => '/^[A-z a-z]*$/i'),
// 														array('invalid' => 'Unique name can only have letters (A-Z) or (a-z).')
// 														),
// 													),
// 												array(),
// 												array('required' => 'Please enter unique name.')),

        'ScreenShot'     			=> new sfValidatorFile(array('required'=>true,
                                                      'required' => $this->isNew(),
                                                      'mime_types'=> $this->Imagetype,
                                                      'path'     => sfConfig::get('app_ThumbnailPath_Thumbpath'),
                                                    ),
                                                array('required'=>'This field is required.')),
        'Features'       			=> new sfValidatorString(array('required'=>true),array('required'=>'This field is required.')),
        'ManageTopMenu'          	=> new sfValidatorBoolean(array('required' => false)),
        'ManageFooterMenu'          	=> new sfValidatorBoolean(array('required' => false)),
        'ManageBanner'				=> new sfValidatorBoolean(array('required' => false)),
        'ManageColorAndBackground'  	=> new sfValidatorBoolean(array('required' => false)),
        'ManageSocialMedia'         	=> new sfValidatorBoolean(array('required' => false)),
        'ChangeLogo'           		=> new sfValidatorBoolean(array('required' => false)),
        'ManageFAQs'           		=> new sfValidatorBoolean(array('required' => false)),
        'BGColor'           			=> new sfValidatorBoolean(array('required' => false)),
        'TextColor'           		=> new sfValidatorBoolean(array('required' => false)),
        'BorderColor'           		=> new sfValidatorBoolean(array('required' => false)),
        'TextWidgets'           		=> new sfValidatorBoolean(array('required' => false)),
        'TextWidgetCombo'			=> new sfValidatorString(array('required' => false),array("required"=>"This field is required.")),
        'LinkColor'           		=> new sfValidatorBoolean(array('required' => false)),
        'LinkHoverColor'           	=> new sfValidatorBoolean(array('required' => false)),
        'BannerTitleCombo'			=> new sfValidatorString(array('required' => false),array("required"=>"This field is required.")),
        'BannerBackground'           	=> new sfValidatorBoolean(array('required' => false)),
        'BodyBackground'          	=> new sfValidatorBoolean(array('required' => false))
        ));

        /* Check unique name at edit time*/
        $this->validatorSchema->setPostValidator(new sfValidatorAnd(
                                                    array(
                                                        new sfValidatorDoctrineUnique(
                                                                array( 'model' => 'Theme',
                                                                       'column' => 'Name',
                                                                       'primary_key' => 'Id',
                                                                       'required' => true,
                                                                       'throw_global_error' => false
                                                                        ),
                                                                array('invalid' =>"Name already in use, please try again. ")
                                                                )
                                                            )
                                                        )
                                            );


		$this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('theme[%s]');
    }
}