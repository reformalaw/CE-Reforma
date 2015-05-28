<?php

/**
 * Roles form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RolesForm extends BaseRolesForm
{
    public function configure()
    {
        parent::configure();
        unset(
        $this['UpdateDateTime'],
        $this['CreateDateTime'],
        $this['Status']
        
        );

        if ($this->getOption("edit")) {
            echo $nameRequire = false;
        }

        $query2 = PermissionsTable::getPermissionsList();
        
        $this->setWidgets(array(
        'Name'     =>  new sfWidgetFormInputText(array(),array('style'=>'width: 215px;')),
        'Permission'   =>  new sfWidgetFormSelectCheckbox(array('choices' =>$query2)),
        'selectAll'     =>  new sfWidgetFormSelectCheckbox(array('choices'=>array(''=>'Select All')))
        ));

        $this->widgetSchema->setLabels(array(
        'Name'     => 'Role Name ',
        'selectAll'     => 'Select Permission ',
        'Permission'   => 'Permissions '
        ));

        $this->setValidators(array(
        'Name'     => new sfValidatorString(array('required' => true,'min_length' => 3,'max_length'=>45),array('required'=>'This field is required.','min_length'=>'Role name must be at least 3 characters long.','max_length'=>'Role Name cannot be longer than 45 characters.')),
        'Permission'   => new sfValidatorString(array('required' => false),array('required'=>'This field is required.')),
        'selectAll'     => new sfValidatorString(array('required' => false))
        ));

        if ($this->getOption("edit")) {
            $this->validatorSchema->setPostValidator(new sfValidatorAnd());
        }else {
            $this->validatorSchema->setPostValidator(new sfValidatorAnd( array(
            new sfValidatorDoctrineUnique(array( 'model' => 'Roles', 'column' => 'Name', 'primary_key' => 'Id', 'required' => true, 'throw_global_error' => false ),array('invalid' => "Role name already in use, please try again. "))
            )));
        }

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('roles[%s]');
    }
}
