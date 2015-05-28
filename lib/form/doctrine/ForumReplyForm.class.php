<?php

/**
 * ForumReply form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ForumReplyForm extends BaseForumReplyForm
{
	public function configure()
	{
		unset(
			  $this["UpdateDateTime"],
			  $this["CreateDateTime"],
			  $this["Status"],
			  $this["ForumId"],
			  $this["TopicId"]
		  );

		$this->setWidgets(array(
		'Id' => new sfWidgetFormInputHidden(),
		/*'ForumId'  => new sfWidgetFormDoctrineChoice(array(
										'model' => 'Forums',
										'query' =>  Doctrine_Query::create()->select('f.Id, f.Title')->from('Forums f')->where('f.Status = ?', sfConfig::get("app_Status_Active") ),
										'multiple' => false,
										'add_empty' => 'Select',
										'order_by' => array('Title', 'asc')
									),array("style"=>"width:460px")),
		'TopicId'  => new sfWidgetFormDoctrineChoice(array(
										'model' => 'ForumTopics',
										'query' =>  Doctrine_Query::create()->select('f.Id, f.Topic')->from('ForumTopics f')->where('f.Status = ?', sfConfig::get("app_Status_Active") ),
										'multiple' => false,
										'add_empty' => 'Select',
										'order_by' => array('Topic', 'asc')
									),array("style"=>"width:460px")),*/
		'Reply'     	=> new sfWidgetFormTextarea(array(),array('cols'=>70,'rows'=>13)),
		));	

		$this->widgetSchema->setLabels(array(
				'ForumId'=> 'Select Forum',
				'TopicId'=> 'Select Topic',
				'Reply' => 'Reply :'
		));		

		$this->setValidators(array(
				'Id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
				/*'ForumId' => new sfValidatorDoctrineChoice(array('model' => 'Forums', 'column' => 'Id', 'multiple' => false),array('required'=>"Please select forum")),
				'TopicId'   => new sfValidatorDoctrineChoice(array('model' => 'ForumTopics', 'column' => 'Id', 'multiple' => false),array('required'=>"Please select topic")),*/
				'Reply'     => new sfValidatorString(array('required' => true),array('required'=>'Please enter replay')),
		));

		$this->validatorSchema->setOption('allow_extra_fields', true);
		$this->widgetSchema->setNameFormat('ForumReply[%s]');
	}
}
