<?php

/**
 * ReviewRating form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReviewRatingForm extends BaseReviewRatingForm
{
	public function configure()
	{
		unset(
				$this["id"],
				$this["UpdateDateTime"],
				$this["CreateDateTime"],
				$this["UserId"],
				$this["Status"],
				$this["Rate"],
			    $this["CustomerId"]
		  );

	$this->setWidgets(array(
		'Id' 		=> new sfWidgetFormInputHidden(),
		'Review'     	=> new sfWidgetFormTextarea(array(),array('cols'=>50,'rows'=>13))
	));

	$this->widgetSchema->setLabels(array(
		'Review' => 'Review'
	));

    $this->setValidators(array(
		'Id'        	=> new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
		'Review'     => new sfValidatorString(array('required' => true),array('required'=>'This field is required.'))
    ));

	$this->validatorSchema->setOption('allow_extra_fields', true);
    $this->widgetSchema->setNameFormat('ReviewRating[%s]');

	}
}