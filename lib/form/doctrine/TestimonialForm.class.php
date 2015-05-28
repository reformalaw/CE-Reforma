<?php

/**
 * Testimonial form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TestimonialForm extends BaseTestimonialForm
{
	public function configure()
	{
		unset(
			$this["UpdateDateTime"],
			$this["CreateDateTime"]
        );

        $this->setWidgets(array(
			'Id' 			=> new sfWidgetFormInputHidden(),
			'ClientName' 	=> new sfWidgetFormInputText(),
			'CompanyName' 	=> new sfWidgetFormInputText(),
			'Description'  	=> new sfWidgetFormTextarea(array(),array('cols'=>110,'rows'=>13))
        ));


        $this->widgetSchema->setLabels(array(
			'ClientName' 	=> 'Client Name',
			'CompanyName'   	=> 'Company Name',
			'Description'   	=> 'Description'
        ));

        $this->setValidators(array(
			'Id'        		=> new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
			'ClientName' 	=> new sfValidatorString(array('max_length' => 150, 'required' => true),array('required'=>'This field is required.')),
			'CompanyName' 	=> new sfValidatorString(array('max_length' => 150, 'required' => true),array('required'=>'This field is required.')),
			'Description'  	=> new sfValidatorString(array('required' => true),array('required'=>'This field is required.'))
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('Testimonial[%s]');
	}
}