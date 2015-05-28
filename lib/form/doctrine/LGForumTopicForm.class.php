<?php

/**
 * LGForumTopics form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LGForumTopicsForm extends BaseForumTopicsForm
{
	public function configure()
	{
		unset( $this["UpdateDateTime"], $this["CreateDateTime"] );

		$this->setWidgets(array(
					'Id' 			=> new sfWidgetFormInputHidden(),
					'Topic' 			=> new sfWidgetFormInputText(array(),array('style'=>'width:460px')),
					'Description'   	=> new sfWidgetFormTextarea(array(),array('cols'=>70,'rows'=>13))
		));

		$this->widgetSchema->setLabels(array(
									'Topic' => 'Topic :',
									'Description' => 'Description :',
									));

		$this->setValidators(array(
						'Id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
						'Topic' 			=> new sfValidatorString(array('max_length' => 256, 'required' => true),array('required'=>'Please enter topic')),
						'Description'   => new sfValidatorString(array('required' => true),array('required'=>'Please enter description'))
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
		$this->widgetSchema->setNameFormat('LGForumsTopic[%s]');
  }
}