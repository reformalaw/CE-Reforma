<?php

/**
 * ThirdParties form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ThirdPartiesForm extends BaseThirdPartiesForm
{
  public function configure()
  {
        parent::setup();
        unset(
               $this['status'],
               $this['CreateDateTime'],
               $this['UpdateDateTime']
            );

        $snStateid = $this->getOption('State');
        
        /* edit time get state id */
        if(!$this->getObject()->isNew())
             $snStateid = $this->getObject()->get('StateId');
    
        //  get state and county name
        $arrCnt = Counties::getCountyByStateId($snStateid);
		$arrCounty = array();		
		$arrCounty[""] = "-- Select County --";
		if(count($arrCnt) > 0)
		{
		  foreach($arrCnt as $county)      
			$arrCounty[$county->getId()] = $county->getName();
		}


  $this->setWidgets(array(
      'Id'             => new sfWidgetFormInputHidden(),
      'Name'           => new sfWidgetFormInputText(),
      'Address1'       => new sfWidgetFormInputText(),
      'Address2'       => new sfWidgetFormInputText(),
      'City'           => new sfWidgetFormInputText(),
      //'CountryId'      => new sfWidgetFormInputText(),
      'StateId'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ThirdPartiesStates'), 'add_empty' => '-- Select State --'),array('style'=>'width:230px')),
    'CountyId'       => new sfWidgetFormSelect(array('choices' => $arrCounty),array('style'=>'width:230px')), 
     // 'CountyId'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ThirdPartiesCounties'), 'add_empty' => '-- select County --')),
      'Zip'            => new sfWidgetFormInputText(),
      //'Status'         => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive'))),
      //'CreateDateTime' => new sfWidgetFormDateTime(),
      //'UpdateDateTime' => new sfWidgetFormDateTime(),
    ));

     $this->widgetSchema->setLabels(array(	    
      'Id' => 'Id',      
      'Name'     => 'Name',  
      'Address1'  => 'Address1',
      'Address2'  => 'Address2',
      'city' =>'city',
      'StateId'=>'State',
      'CountyId'=>'County',
      'Zip'=>'Zip',
	));

    $this->setValidators(array(
      'Id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'Name'           => new sfValidatorString(array('max_length' => 45,'required'=>true),array('required'=>'This field is required.')),
       /*'Name'           => new sfValidatorAnd(
                                            array(
                                                   new sfValidatorString(array('max_length' => 150,'required'=>true)) ,
                                                   new sfValidatorDoctrineUnique(array('model'=>'ThirdParties', 'column'=>'Name')) ,
                                                 ) ,
                                             array() ,
                                             array(
                                                    'invalid'     => 'Name alreday in use, Please provide another !!' ,
                                                    'required'    => 'Please enter Name' ,
                                                  )
                                            ),*/
      'Address1'       => new sfValidatorString(array('max_length' => 45,'required'=>true),array('required'=>'This field is required.')),
      'Address2'       => new sfValidatorString(array('max_length' => 45,'required'=>false)),
      'City'           => new sfValidatorString(array('max_length' => 45,'required'=>true),array('required'=>'This field is required.')),
      //'CountryId'      => new sfValidatorInteger(),
      'StateId'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ThirdPartiesStates'),'required'=>true),array('required'=>'This field is required.')),
      'CountyId'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ThirdPartiesCounties'),'required'=>true),array('required'=>'This field is required.')),
      'Zip'            => new sfValidatorString(array('max_length' => 10,'required'=>true),array('required'=>'This field is required.')),
     // 'Status'         => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive'))),
      //'CreateDateTime' => new sfValidatorDateTime(),
      //'UpdateDateTime' => new sfValidatorDateTime(),
    ));

     /* Check unique name at edit time*/
    $this->validatorSchema->setPostValidator(new sfValidatorAnd( 
                                                array(
                                                new sfValidatorDoctrineUnique(
                                                        array( 'model' => 'ThirdParties', 
                                                               'column' => 'Name', 
                                                               'primary_key' => 'Id', 
                                                               'required' => true, 
                                                               'throw_global_error' => false 
                                                                ),
                                                        array('invalid' =>"Name alreday in use, Please provide another !!")
                                                           )
                                                    )
                                                  )
                                                );

     
    $this->widgetSchema->setNameFormat('third_parties[%s]');
     }
}
