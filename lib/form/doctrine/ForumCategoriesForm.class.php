<?php

/**
 * ForumCategories form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ForumCategoriesForm extends BaseForumCategoriesForm
{
    public function configure()
    {
        unset(
        $this["UpdateDateTime"],
        $this["CreateDateTime"],
        $this["Staus"]
        );

        $this->setWidgets(array(
        'Id' => new sfWidgetFormInputHidden(),
        'Title' 	=> new sfWidgetFormInputText(array(),array('style'=>'width:460px')),
        'Description'     	=> new sfWidgetFormTextarea(array(),array('cols'=>70,'rows'=>13)),
        ));

        $this->widgetSchema->setLabels(array(
        'Question' => 'Question',
        'Answer'   => 'Answer',
        'Globle'   => 'Global',
        'Status'   => 'Status',
        ));

        $this->setValidators(array(
        'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
        'Title' => new sfValidatorString(array('max_length' => 256, 'required' => true),array('required'=>'Please Enter Title')),
        'Description'     => new sfValidatorString(array('required' => true),array('required'=>'Please enter description')),
        ));

        $this->validatorSchema->setPostValidator(new sfValidatorAnd(
        array(
        new sfValidatorDoctrineUnique(
        array( 'model' => 'ForumCategories',
        'column' => 'Title',
        'primary_key' => 'Id',
        'required' => true,
        'throw_global_error' => false
        ),
        array('invalid' =>"Title alreday in use, please provide another !!")
        )
        )
        )
        );

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('ForumCategories[%s]');

    }
}
