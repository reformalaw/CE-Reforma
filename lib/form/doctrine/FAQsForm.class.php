<?php

/**
 * FAQs form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FAQsForm extends BaseFAQsForm
{
    public function configure()
    {
        unset(
        $this["id"],
        $this["UpdateDateTime"],
        $this["CreateDateTime"],
        $this["Globle"],
        $this["Status"]
        );

        $this->setWidgets(array(
        'webId'       => new sfWidgetFormInputHidden(array(),array('value'=>$this->getOption('webId'))),
        'Question' 	=> new sfWidgetFormInputText(array(),array('style'=>'width:600px')),
        'Answer'     	=> new sfWidgetFormTextarea(array(),array('cols'=>110,'rows'=>13)),
        ));

        // $widgetSchema['webId'] = new sfWidgetFormInputHidden(array(),array('value'=>$this->getOption('webId')));

        $this->widgetSchema->setLabels(array(
        'Question' => 'Question',
        'Answer'   => 'Answer',
        'Globle'   => 'Global',
        'Status'   => 'Status',
        ));

        $this->setValidators(array(
        // 'webId'	=> new sfValidatorString(array('required'=>false)),
        'Question' => new sfValidatorString(array('max_length' => 256, 'required' => true),array('required'=>'This field is required.')),
        'Answer'     => new sfValidatorString(array('required' => true),array('required'=>'This field is required.')),
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('FAQs[%s]');

    }
}
