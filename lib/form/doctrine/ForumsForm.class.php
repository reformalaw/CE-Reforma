<?php

/**
 * Forums form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ForumsForm extends BaseForumsForm
{
	public function configure()
	{
		unset( $this["UpdateDateTime"], $this["CreateDateTime"], $this["Staus"]);

		$this->setWidgets(array(
			'Id' 				=> new sfWidgetFormInputHidden(),
			'Title' 				=> new sfWidgetFormInputText(array(),array('style'=>'width:460px')),
			'Description'    	=> new sfWidgetFormTextarea(array(),array('cols'=>70,'rows'=>13)),
			'ForumCategoriesId' 	=> new sfWidgetFormDoctrineChoice(array(
											'model' 		=> 'ForumCategories',
											'query' 		=>  Doctrine_Query::create()->select('f.Id, f.Title')->from('ForumCategories f')->where('f.Status = ?', "Active" ),
											'multiple' 	=> false,
											'add_empty'	=> 'Select',
											'order_by' 	=> array('Title', 'asc')
								),array("style"=>"width:230px")),
						));

		$this->widgetSchema->setLabels(array('ForumCategoriesId'=> 'Select Category',));

		$this->setValidators(array(
						'Id'             	=> new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
						'Title' 				=> new sfValidatorString(array('max_length' => 256, 'required' => true),array('required'=>'Please enter title')),
						'Description'     	=> new sfValidatorString(array('required' => true),array('required'=>'Please enter description')),
						'ForumCategoriesId' => new sfValidatorDoctrineChoice(array('model' => 'ForumCategories', 'column' => 'Id', 'multiple' => false),array('required'=>"Please select category")),
			));

		$this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
													new sfValidatorDoctrineUnique(array( 'model' => 'Forums',
															'column' 			=> 'Title',
															'primary_key' 		=> 'Id',
															'required' 			=> true,
															'throw_global_error'	=> false
															),array('invalid' =>"Title alreday in use, please provide another !!")
												))));

		$this->validatorSchema->setOption('allow_extra_fields', true);
		$this->widgetSchema->setNameFormat('Forums[%s]');
	}
}