<?php

/**
 * Permissions form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PermissionsForm extends BasePermissionsForm
{
    public function configure()
    {
        parent::configure();
        unset(
        $this['UpdateDateTime'],
        $this['CreateDateTime']
        );

        if ($this->getOption("edit")) {
            echo $UniqueKeyRequire = false;
        }

        $query2 = PermissionsTable::getPermissionsList();

        $this->setWidgets(array(
        'Name'     =>  new sfWidgetFormInputText(array(),array('style'=>'width: 215px;')),
        'UniqueKey' => new sfWidgetFormInputText(array(),array('style'=>'width: 215px;'))
        ));

        $this->widgetSchema->setLabels(array(
        'Name'     => 'Permission Name ',
        'UniqueKey'     => 'Unique Key '
        ));

        $this->setValidators(array(
        'Name'     => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>50),array('required'=>'Please Enter Permmsion Name','min_length'=>'Please Enter More than 3 characters','max_length'=>'Please Enter Less than 50 characters')),
        'UniqueKey'     => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>50),array('required'=>'Please Enter Unique Key','min_length'=>'Please Enter More than 3 characters','max_length'=>'Please Enter Less than 50 characters'))
        ));

        if ($this->getOption("edit")) {
            $this->validatorSchema->setPostValidator(new sfValidatorAnd());
        }else {
            $this->validatorSchema->setPostValidator(new sfValidatorAnd( array(
            new sfValidatorDoctrineUnique(array( 'model' => 'Permissions', 'column' => 'UniqueKey', 'primary_key' => 'Id', 'required' => true, 'throw_global_error' => false ),array('invalid' => "Unique Key is already in use")),
            )));
        }

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('permissions[%s]');

    }
}
