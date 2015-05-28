<?php

/**
 * AttorneyContact form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Chintan Fadia
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AttorneyContactForm extends BaseAttorneyContactForm
{
    public function configure()
    {


        parent::configure();

        $elements = AttorneyContactTable::getCustomers($this->getOption('userId'));
        #clsCommon::pr($elements);
        foreach ($elements as $element )
        {

            $widgetName = $this->getWidgetName($element);
            $args = $this->getConstructorArguments($element);

            $widgets['input_'.$element['Id'].'_'.$element['UserId']] = new $widgetName($args);

            $validatorName = 'sfValidatorString';

            if($element['FieldType']=='Captcha'){

                #$validators[$element['Label']] = new sfValidatorSfCryptoCaptcha(array('required' => true, 'trim' => true),array('wrong_captcha' => 'Please enter valid Code','required' => 'Please enter the Code'));
                if($element['Required'] =='Yes')
                $validators['input_'.$element['Id'].'_'.$element['UserId']] = new sfValidatorSfCryptoCaptcha(array('required' => true, 'trim' => true),array('wrong_captcha' => 'Please enter valid '.$element['Label'],'required' => 'Please enter the '.$element['Label']));
                else
                $validators['input_'.$element['Id'].'_'.$element['UserId']] = new sfValidatorSfCryptoCaptcha(array('required' => false));


            } else if($element['FieldType']=='FileUpload'){


                if($element['Required']=='Yes')
                $validators['input_'.$element['Id'].'_'.$element['UserId']] = new sfValidatorFile(array('required' => true),array('required' => "Please provide ".$element['Label']));
                else
                $validators['input_'.$element['Id'].'_'.$element['UserId']] = new sfValidatorFile(array('required' => false));


            }else{

                if($element['Required']=='Yes')
                $validators['input_'.$element['Id'].'_'.$element['UserId']] = new $validatorName(array('required' => true),array('required'=>"Please enter ".$element['Label']));
                else
                $validators['input_'.$element['Id'].'_'.$element['UserId']] = new $validatorName(array('required' => false));

            }

        }

        #clsCommon::pr($validators);

        $this->setWidgets($widgets);

        $this->setValidators($validators);

        $this->validatorSchema->setOption('allow_extra_fields', true);

        $this->widgetSchema->setNameFormat('customer[%s]');
    } // End of configure


    protected function getWidgetName($element)
    {

        switch ($element['FieldType'])
        {

            case 'Text':
                return 'sfWidgetFormInputText';
            case 'TextArea':
                return 'sfWidgetFormTextArea';
            case 'DropDown':
                return 'sfWidgetFormSelect';
            case 'CheckBox':
                return 'sfWidgetFormSelectCheckbox';		//sfWidgetFormInputCheckbox, sfWidgetFormChoice
            case 'Radio':
                return 'sfWidgetFormSelectRadio';
            case 'Captcha':
                return 'sfWidgetFormInput';
            case 'FileUpload':
                return 'sfWidgetFormInputFile';
            case 'Captcha':
                return 'sfWidgetFormInput';
            default:
                return 'sfWidgetFormInput' . ucwords( $element['FieldType'] );
        }
    }

    protected function getConstructorArguments( $element )
    {

        $return = array(
        'label' => $element['Label'],
        );


        switch ($element['FieldType'] )
        {
            case 'DropDown':
                $newArray = explode(',',$element['Options']);
                foreach ($newArray as $val){
                    $result['']='Select';
                    $result[$val] = $val;
                }

                $return['choices'] =$result;
                break;

            case 'CheckBox':
            case 'Radio':
                /*$newArray = explode(',',$element['Options']);
                foreach ($newArray as $val){
                    $result[$val] = $val;
                }

                $return['choices'] = $result;
                break;*/
                
                $newArray = explode(',',$element['Options']);
                $slugArray = explode(',',$element['OptionsSlug']);
                $combinArr = array_combine($slugArray, $newArray);
                #clsCommon::pr($combinArr);

                $return['choices'] = $combinArr;
                break;
                

                /*case 'CheckBox':
                $newArray = explode(',',$element['Options']);
                foreach ($newArray as $val){
                $result[$val] = $val;
                }

                $return['choices'] = $result;
                break;*/


        }

        return $return;
    }
} // End of class
