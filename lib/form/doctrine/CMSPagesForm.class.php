<?php

/**
 * CMSPages form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Krunal Nerikar
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CMSPagesForm extends BaseCMSPagesForm
{
    public function configure()
    {
        parent::configure();
        unset(
        $this['UpdateDateTime'],
        $this['WebsiteId'],
        $this['CreateDateTime'],
        $this['UniqueKey'],
        $this['Status']
        );

        if ($this->getOption("edit")) {
            echo $nameRequire = false;
        }

        $this->setWidget('Content', new sfWidgetFormFCKEditor(array('rows'=> 40)));
        $this->setWidget('Status', new sfWidgetFormChoice(array('choices' => array(''=>'Select One','Active' => 'Active', 'Inactive' => 'Inactive'))));
        $this->setWidget('Url', new sfWidgetFormInputText());

        $this->widgetSchema->setLabels(array(
        'Title'             => 'Page Title ',
        'SubTitle'          => 'Page Sub Title ',
        'MetaTitle'         => 'Page Meta Title ',
        'MetaKeywords'      => 'Page Meta Keywords ',
        'MetaDescription'   => 'Page Meta Description ',
        'Content'           => 'Page Content ',
        'Url'               => 'Page Url '
        ));

        $this->setValidators(array(
        'Title'             => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>150),array('required'=>'This field is required.','min_length'=>'Title must be at least 3 characters long.','max_length'=>'Title cannot be longer than 150 characters.')),
        'SubTitle'          => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>150),array('required'=>'This field is required.','min_length'=>'Sub Title must be at least 3 characters long.','max_length'=>'Sub Title cannot be longer than 150 characters.')),
        'MetaTitle'         => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>250),array('required'=>'This field is required.','min_length'=>'Meta Title must be at least 3 characters long.','max_length'=>'Meta Title cannot be longer than 150 characters.')),
        'MetaKeywords'      => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>250),array('required'=>'This field is required.','min_length'=>'Meta Keywords must be at least 3 characters long.','max_length'=>'Meta Keywords cannot be longer than 150 characters.')),
        'MetaDescription'   => new sfValidatorString(array('required' => true,'min_length' => 3),array('required'=>'This field is required.','min_length'=>'Meta Description must be at least 3 characters long.')),
        'Content'           => new sfValidatorString(array('required' => true,'min_length' => 3),array('required'=>'This field is required.','min_length'=>'Content must be at least 3 characters long.')),

        ));

        if ($this->getOption("edit")) {
            $this->validatorSchema->setPostValidator(new sfValidatorAnd());
        }else {
            $this->validatorSchema->setPostValidator(new sfValidatorAnd( array(
            new sfValidatorDoctrineUnique(array( 'model' => 'CMSPages', 'column' => 'UniqueKey', 'primary_key' => 'Id', 'required' => true, 'throw_global_error' => false ),array('invalid' => "Page Name is already in use"))
            )));
        }

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('cmspages[%s]');
    }
}