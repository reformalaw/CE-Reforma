<?php

/**
 * WebsitePracticeArea form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class WebsitePracticeAreaForm extends BaseWebsitePracticeAreaForm
{
    public function configure()
    {
		if(!$this->isNew())
		{
			$webId 	= 	$this->getOption('webId');;
			$Id     = $this->getOption('Id');
			$flag = WebsiteMenuTable::checkPracticeOrCmsExist($webId,"WebsitePracticeAreaId", $Id);
			if($flag)
				$Status = array(""=> "Select", "Active" => "Active","Inactive" => "Inactive");
			else
				$Status = array(""=> "Select", "Active" => "Active");
		}
		else
			$Status = array(""=> "Select", "Active" => "Active","Inactive" => "Inactive");

        $type = array(	""=> "Select",
        sfConfig::get("app_WebsitePrecticeType_Left") 	=> sfConfig::get("app_WebsitePrecticeType_Left"),
        sfConfig::get("app_WebsitePrecticeType_Page") 	=> sfConfig::get("app_WebsitePrecticeType_Page"),
        sfConfig::get("app_WebsitePrecticeType_Right")	=> sfConfig::get("app_WebsitePrecticeType_Right")
        );

        $Template = array(""=> "Select", 'column1'=> sfConfig::get("app_WebsitePracticeAreaTemplate_Column1"),'column2L'=> sfConfig::get("app_WebsitePracticeAreaTemplate_Column2L"), 'column2R'=>sfConfig::get("app_WebsitePracticeAreaTemplate_Column2R"));
        unset($this['UpdateDateTime'], $this['WebsiteId'], $this['CreateDateTime']);

        $this->setWidgets(array(
        'Id' 				=> new sfWidgetFormInputHidden(),
        'Title' 			=> new sfWidgetFormInputText(array(),array('style'=>'width:400px')),
        'SubTitle' 			=> new sfWidgetFormInputText(array(),array('style'=>'width:400px')),
        'MetaTitle' 		=> new sfWidgetFormInputText(array(),array('style'=>'width:400px')),
        'MetaKeywords' 		=> new sfWidgetFormInputText(array(),array('style'=>'width:400px')),
        'MetaDescription' 	=> new sfWidgetFormTextarea(array(),array('cols'=>90,'rows'=>5,'style'=>'width:400px')),
        'Content'     		=> new sfWidgetFormFCKEditor(array('rows'=>40)),
        'Template'    		=> new sfWidgetFormSelect(array('choices'=>$Template),array("style"=>"width:230px")),
        'Status'    		=> new sfWidgetFormSelect(array('choices'=>$Status),array("style"=>"width:230px")),
        ));

        $this->widgetSchema->setLabels(array(
        'Title'				=> 'Title',
        'SubTitle' 			=> 'Sub Title',
        'MetaTitle' 		=> 'Meta Title' ,
        'MetaKeywords' 		=> 'Meta Keywords',
        'MetaDescription' 	=> 'Meta Description'
        ));

        $this->setValidators(array(
        'Id'             	=> new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
        'Title' 			=> new sfValidatorString(array('trim'=>true,'max_length' => 256, 'required' => true),array('required'=>'This field is required.')),
        'SubTitle'          => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>150),array('required'=>'This field is required.','min_length'=>'Sub Title must be at least 3 characters long.','max_length'=>'Sub Title cannot be longer than 150 characters.')),
        'MetaTitle'			=> new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>150),array('required'=>'This field is required.','min_length'=>'Meta Title must be at least 3 characters long.','max_length'=>'Meta Title cannot be longer than 150 characters.')),
        'MetaKeywords'      => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>150),array('required'=>'This field is required.','min_length'=>'Meta Keywords must be at least 3 characters long.','max_length'=>'Meta Keywords cannot be longer than 150 characters.')),
        'MetaDescription'   => new sfValidatorString(array('required' => true,'min_length' => 3),array('required'=>'This field is required.','min_length'=>'Meta Description must be at least 3 characters long.')),
        'Content'       	=> new sfValidatorString(array('required' => true,'min_length' => 3),array('required'=>'This field is required.','min_length'=>'Please enter more than 3 characters')),
        'Template'			=> new sfValidatorString(array('required' => true),array("required"=>"This field is required.")),
        'Status'			=> new sfValidatorString(array('required' => true),array("required"=>"This field is required.")),
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('WebsitePracticeArea[%s]');
    }
}