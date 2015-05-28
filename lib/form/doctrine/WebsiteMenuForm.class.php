<?php

/**
 * WebsiteMenu form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class WebsiteMenuForm extends BaseWebsiteMenuForm
{
	public function configure()
	{
		$type = sfConfig::get("app_Menutype");
		
		if(!$this->isNew())
		{
			/* Edit time first time load the data */
			$Id        = $this->getOption('Id');
			$tableType = $this->getOption("tableType");
		}

		//print_r($type);exit;
		$webId = sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId');
		unset( $this["UpdateDateTime"], $this["CreateDateTime"] );

		$this->setWidgets(array(
			'Id' 					=> new sfWidgetFormInputHidden(),
			'Title' 					=> new sfWidgetFormInputText(array(),array('style'=>'width:225px')),
			'Type'    				=> new sfWidgetFormSelect(array('choices'=>array(''=>'Select')+$type),array("style"=>"width:230px")),
			'CmsPageId' 				=> new sfWidgetFormDoctrineChoice(array(
												'model' 		=> 'CMSPages',
												'query' 		=>  Doctrine_Query::create()->select('spf.Id, spf.Title')->from('CMSPages spf')->where('spf.WebsiteId = ?', $webId )->andWhere('spf.Status = ?',sfConfig::get("app_Status_Active")),
												'multiple' 	=> false,
												'add_empty'	=> 'Select',
												'order_by' 	=> array('Title', 'asc')
											),array("style"=>"width:230px")),
			'WebsitePracticeAreaId' 	=> new sfWidgetFormDoctrineChoice(array(
												'model' 		=> 'WebsitePracticeArea',
												'query' 		=>  Doctrine_Query::create()->select('pa.Id, pa.Title')->from('WebsitePracticeArea pa')->where('pa.WebsiteId = ?', $webId)->andWhere('pa.Status = ?',sfConfig::get("app_Status_Active")),
												'multiple' 	=> false,
												'add_empty'	=> 'Select',
												'order_by' 	=> array('Title', 'asc')
											),array("style"=>"width:230px")),
						));
			if($this->isNew())
			{
				$websiteMenuDatas = Doctrine_Query::create()->select('wm.Id, wm.Title')->from('WebsiteMenu wm')->where('wm.WebsiteId = ?', $webId )->andWhere("wm.ParentId = ?",0)->andwhere("wm.MenuType = ?", sfConfig::get("app_MenuType_Header"))->orderBy('wm.Title ASC')->fetchArray();
				$parentValue = array();
				$parentValue[0] = "Main Menu";
				foreach($websiteMenuDatas as $websiteMenuData)
				{
					$parentValue[$websiteMenuData["Id"]] = $websiteMenuData["Title"];
				}
				
				$this->setWidget(
						'ParentId'	, new sfWidgetFormSelect(array('choices'=>array(''=>'Select')+$parentValue),array("style"=>"width:230px"))
				);

			}
			else
			{	
				$parentValue = array();
				$parentValue[0] = "Main Menu";

				/* this query check that chiled exist or not */
				$chiledExist = Doctrine_Query::create()->select('wm.Id')->from('WebsiteMenu wm')->where('wm.WebsiteId = ?', $webId )->andWhere("wm.ParentId = ?",$this->getObject()->get('Id'))->andWhere("wm.MenuType = ?",sfConfig::get("app_MenuType_Header"))->fetchArray();
				
				if(count($chiledExist) > 0)
				{
					/* if chiled exist then give only one main menu */
				}
				else
				{
					$websiteMenuDatas = Doctrine_Query::create()->select('wm.Id, wm.Title')->from('WebsiteMenu wm')->where('wm.WebsiteId = ?', $webId )->andWhere("wm.ParentId = ?",0)->andWhere("wm.MenuType = ?",sfConfig::get("app_MenuType_Header"))->whereNotIn('wm.Id', $Id)->orderBy('wm.Title ASC')->fetchArray();
					foreach($websiteMenuDatas as $websiteMenuData)
					{
						$parentValue[$websiteMenuData["Id"]] = $websiteMenuData["Title"];
					}
				}

				$this->setWidget(
						'ParentId'	, new sfWidgetFormSelect(array('choices'=>array(''=>'Select')+$parentValue),array("style"=>"width:230px"))
				);
			}
		$this->widgetSchema->setLabels(array('ParentId'=> 'Select Parent','CmsPageId'=>"Select CMS Page",'WebsitePracticeAreaId'=>'Select Practice Area'));

		$this->setValidators(array(
						'Id'             		=> new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
						'Title' 					=> new sfValidatorString(array('max_length' => 256, 'required' => true),array('required'=>'This field is required.')),
						'Type'        			=> new sfValidatorString(array('required' => true),array('required'=>'This field is required.')),
						'CmsPageId ' 			=> new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'CMSPages', 'column' => 'Id', 'multiple' => false)),
						'WebsitePracticeAreaId' 	=> new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'WebsitePracticeArea', 'column' => 'Id', 'multiple' => false)),
						'ParentId'        		=> new sfValidatorString(array('required' => true),array('required'=>'This field is required.')),
						//'ParentId ' 				=> new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'WebsiteMenu', 'column' => 'Id', 'multiple' => false)),
			));

		$this->validatorSchema->setOption('allow_extra_fields', true);
		$this->widgetSchema->setNameFormat('WebsiteMenu[%s]');
	}
}