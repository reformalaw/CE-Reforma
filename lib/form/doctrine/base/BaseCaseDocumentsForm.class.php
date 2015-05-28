<?php

/**
 * CaseDocuments form base class.
 *
 * @method CaseDocuments getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCaseDocumentsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'                     => new sfWidgetFormInputHidden(),
      'CaseId'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CaseDocumentsCases'), 'add_empty' => false)),
      'BillDocumentRealName'   => new sfWidgetFormInputText(),
      'BillDocumentSystemName' => new sfWidgetFormInputText(),
      'CreateDateTime'         => new sfWidgetFormDateTime(),
      'UpdateDateTime'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'CaseId'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CaseDocumentsCases'))),
      'BillDocumentRealName'   => new sfValidatorString(array('max_length' => 150)),
      'BillDocumentSystemName' => new sfValidatorString(array('max_length' => 150)),
      'CreateDateTime'         => new sfValidatorDateTime(),
      'UpdateDateTime'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('case_documents[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CaseDocuments';
  }

}
