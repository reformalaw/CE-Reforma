<?php

/**
 * PracticeAreas form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PracticeAreasForm extends BasePracticeAreasForm
{
    public function configure()
    {
        parent::configure();

        unset(
        $this['Id'],
        $this['CreateDateTime']
        );
        
        if ($this->getOption("edit")) {
            echo $emailRequire = false;
        }
        
        $Query = PracticeAreasTable::getPracticeAreaParentList();
        
        $this->setWidgets(array(
        'Name'                    =>  new sfWidgetFormInputText(array(),array('style'=>'width:220px;')),
        //'ParentId'                =>  new myTreeWidgetFormCheckboxes(array('choices' => $Query,'treeid'=>'treeCountry','class'=>'checkboxTree')),
        'ParentId'                =>  new sfWidgetFormChoice(array('choices' =>  array( '' => 'Select Category')+$Query),array('style'=>'width:226px;')),
        //'ChildList'               => new sfWidgetFormSelect(array('choices'=>$child)),
        'Description'             =>  new sfWidgetFormTextarea()
        ));

        $this->widgetSchema->setLabels(array(
        'Name'         => 'Practice Areas Name ',
        'ParentId'     => 'Parent Category ',
        'Description'  => 'Description ',
        ));


        $this->setValidators(array(
        'Name'         => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>45),array('required'=>'This field is required.','min_length'=>'Name must be at least 3 characters long.','max_length'=>'Name cannot be longer than 45 characters.')),
        //'ParentId'     => new sfValidatorDoctrineChoice(array('required' => false,'model' => $this->getRelatedModelName('PracticeAreasParents'))),
        'Description'  => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>500),array('required'=>'This field is required.','min_length'=>'Description must be at least 3 characters long.','max_length'=>'Description cannot be longer than 500 characters.'))
        ));

        if ($this->getOption("edit")) {
            $this->validatorSchema->setPostValidator(new sfValidatorAnd( ));
        }else {
            $this->validatorSchema->setPostValidator(new sfValidatorAnd( array(
            new sfValidatorDoctrineUnique(array( 'model' => 'PracticeAreas', 'column' => 'Name', 'primary_key' => 'Id', 'required' => true, 'throw_global_error' => false ),array('invalid' => "Category name already in use, please try again. ")),
            )));
        }
        
        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('practiceareas[%s]');
    }
}