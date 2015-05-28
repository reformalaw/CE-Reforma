<?php

/**
 * ForumTopics form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ForumTopicsForm extends BaseForumTopicsForm
{
	public function configure()
	{
		unset( $this["UpdateDateTime"], $this["CreateDateTime"] );

		if(!$this->isNew())
			$query = Doctrine_Query::create()->select('f.Id, f.Title')->from('Forums f')->where('f.Status = ?', sfConfig::get("app_Status_Active") )->andWhere('f.Id = ?', $this->getOption('formusId'));
		else
			$query = Doctrine_Query::create()->select('f.Id, f.Title')->from('Forums f')->where('f.Status = ?', sfConfig::get("app_Status_Active") );

		$this->setWidgets(array(
					'Id' 			=> new sfWidgetFormInputHidden(),
					'Topic' 			=> new sfWidgetFormInputText(array(),array('style'=>'width:460px')),
					'Description'   	=> new sfWidgetFormTextarea(array(),array('cols'=>70,'rows'=>13)),
					'ForumId'  		=> new sfWidgetFormDoctrineChoice(array(
												'model' 		=> 'Forums',
												'query' 		=>  $query,//Doctrine_Query::create()->select('f.Id, f.Title')->from('Forums f')->where('f.Status = ?', sfConfig::get("app_Status_Active") ),
												'multiple' 	=> false,
												'add_empty' 	=> 'Select',
												'order_by' 	=> array('Title', 'asc')
											),array("style"=>"width:460px")),
		));

		$this->widgetSchema->setLabels(array(
							'ForumId'=> 'Select Forum',
									));

		$this->setValidators(array(
						'Id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
						'Topic' 			=> new sfValidatorString(array('max_length' => 256, 'required' => true),array('required'=>'Please enter topic')),
						'Description'   => new sfValidatorString(array('required' => true),array('required'=>'Please enter description')),
						'ForumId'     	=> new sfValidatorDoctrineChoice(array('model' => 'Forums', 'column' => 'Id', 'multiple' => false),array('required'=>"Please select forum")),
					));

		$this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
                                                        new sfValidatorDoctrineUnique(array(
																	'model' 				=> 'ForumTopics',
																	'column' 			=> 'Topic',
																	'primary_key' 		=> 'Id',
																	'required' 			=> true,
																	'throw_global_error'	=> false
                                                                        ),
                                                                array('invalid' =>"Topic alreday in use, please provide another !!")
												))));

		$this->validatorSchema->setOption('allow_extra_fields', true);
		$this->widgetSchema->setNameFormat('ForumsTopic[%s]');
  }
}