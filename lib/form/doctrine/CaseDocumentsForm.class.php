<?php

/**
 * CaseDocuments form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CaseDocumentsForm extends BaseCaseDocumentsForm
{
    public function configure()
    {
        unset( $this["UpdateDateTime"],$this["CreateDateTime"], $this['BillDocumentRealName'], $this['BillDocumentSystemName'] );

        $this->setWidgets(array(
        'Id' 		=> new sfWidgetFormInputHidden(),
        'caseId'    => new sfWidgetFormInputHidden(array(),array('value'=>$this->getOption('caseId'))),
        'Document'  => new sfWidgetFormInputFile(),
        ));

        $this->widgetSchema->setLabels(array(
        'Document'  => "Upload Document",
        ));

        $this->setValidators(array(
        'Id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
        'Document'  => new sfValidatorFile(array('required' => true),array('required' => 'Please upoad a document.')),
        ));


        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('CaseDocuments[%s]');
    }
}
