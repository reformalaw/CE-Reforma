<?php

/**
 * Cases form base class.
 *
 * @method Cases getObject() Returns the current form's model object
 *
 * @package    counceledge
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCasesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'Id'                       => new sfWidgetFormInputHidden(),
      'UserId'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CasesUsers'), 'add_empty' => false)),
      'CaseNo'                   => new sfWidgetFormInputText(),
      'Description'              => new sfWidgetFormTextarea(),
      'FirstTitle'               => new sfWidgetFormInputText(),
      'LastTitle'                => new sfWidgetFormInputText(),
      'ThirdParty'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CasesThirdParties'), 'add_empty' => false)),
      'BillDocumentRealName'     => new sfWidgetFormInputText(),
      'BillDocumentSystemName'   => new sfWidgetFormInputText(),
      'ActualAmount'             => new sfWidgetFormInputText(),
      'CommisionPercentage'      => new sfWidgetFormInputText(),
      'CommisionActual'          => new sfWidgetFormInputText(),
      'ProcessingFees'           => new sfWidgetFormInputText(),
      'UnderpayAdjustment'       => new sfWidgetFormInputText(),
      'PayableAmount'            => new sfWidgetFormInputText(),
      'PaidAmount'               => new sfWidgetFormInputText(),
      'RemainToPay'              => new sfWidgetFormInputText(),
      'ReceivedAmount'           => new sfWidgetFormInputText(),
      'RemainToReceive'          => new sfWidgetFormInputText(),
      'DifferenceAmount'         => new sfWidgetFormInputText(),
      'CustomerPaidDate'         => new sfWidgetFormDateTime(),
      'PaymentReceivedDate'      => new sfWidgetFormDateTime(),
      'AgreementDate'            => new sfWidgetFormDateTime(),
      'Stage'                    => new sfWidgetFormChoice(array('choices' => array('Submitted' => 'Submitted', 'Accepted' => 'Accepted', 'Paid' => 'Paid', 'Close' => 'Close'))),
      'Status'                   => new sfWidgetFormChoice(array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'CreatedBy'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CasesUsersCreatedBy'), 'add_empty' => false)),
      'ThirdPartyBillsSubmitted' => new sfWidgetFormChoice(array('choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'CheckNo'                  => new sfWidgetFormInputText(),
      'CreateDateTime'           => new sfWidgetFormDateTime(),
      'UpdateDateTime'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'Id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('Id')), 'empty_value' => $this->getObject()->get('Id'), 'required' => false)),
      'UserId'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CasesUsers'))),
      'CaseNo'                   => new sfValidatorString(array('max_length' => 15)),
      'Description'              => new sfValidatorString(),
      'FirstTitle'               => new sfValidatorString(array('max_length' => 50)),
      'LastTitle'                => new sfValidatorString(array('max_length' => 50)),
      'ThirdParty'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CasesThirdParties'))),
      'BillDocumentRealName'     => new sfValidatorString(array('max_length' => 150)),
      'BillDocumentSystemName'   => new sfValidatorString(array('max_length' => 150)),
      'ActualAmount'             => new sfValidatorNumber(),
      'CommisionPercentage'      => new sfValidatorNumber(),
      'CommisionActual'          => new sfValidatorNumber(),
      'ProcessingFees'           => new sfValidatorNumber(),
      'UnderpayAdjustment'       => new sfValidatorNumber(),
      'PayableAmount'            => new sfValidatorNumber(),
      'PaidAmount'               => new sfValidatorNumber(),
      'RemainToPay'              => new sfValidatorNumber(),
      'ReceivedAmount'           => new sfValidatorNumber(),
      'RemainToReceive'          => new sfValidatorNumber(),
      'DifferenceAmount'         => new sfValidatorNumber(),
      'CustomerPaidDate'         => new sfValidatorDateTime(array('required' => false)),
      'PaymentReceivedDate'      => new sfValidatorDateTime(array('required' => false)),
      'AgreementDate'            => new sfValidatorDateTime(),
      'Stage'                    => new sfValidatorChoice(array('choices' => array(0 => 'Submitted', 1 => 'Accepted', 2 => 'Paid', 3 => 'Close'))),
      'Status'                   => new sfValidatorChoice(array('choices' => array(0 => 'Active', 1 => 'Inactive', 2 => 'Deleted'))),
      'CreatedBy'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CasesUsersCreatedBy'))),
      'ThirdPartyBillsSubmitted' => new sfValidatorChoice(array('choices' => array(0 => 'Yes', 1 => 'No'))),
      'CheckNo'                  => new sfValidatorString(array('max_length' => 50)),
      'CreateDateTime'           => new sfValidatorDateTime(),
      'UpdateDateTime'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('cases[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cases';
  }

}
