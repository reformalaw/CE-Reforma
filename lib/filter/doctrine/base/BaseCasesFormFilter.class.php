<?php

/**
 * Cases filter form base class.
 *
 * @package    counceledge
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCasesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'UserId'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CasesUsers'), 'add_empty' => true)),
      'CaseNo'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Description'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'FirstTitle'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'LastTitle'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ThirdParty'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CasesThirdParties'), 'add_empty' => true)),
      'BillDocumentRealName'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'BillDocumentSystemName'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ActualAmount'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CommisionPercentage'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CommisionActual'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ProcessingFees'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'UnderpayAdjustment'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'PayableAmount'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'PaidAmount'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'RemainToPay'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ReceivedAmount'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'RemainToReceive'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'DifferenceAmount'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CustomerPaidDate'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'PaymentReceivedDate'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'AgreementDate'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'Stage'                    => new sfWidgetFormChoice(array('choices' => array('' => '', 'Submitted' => 'Submitted', 'Accepted' => 'Accepted', 'Paid' => 'Paid', 'Close' => 'Close'))),
      'Status'                   => new sfWidgetFormChoice(array('choices' => array('' => '', 'Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'CreatedBy'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CasesUsersCreatedBy'), 'add_empty' => true)),
      'ThirdPartyBillsSubmitted' => new sfWidgetFormChoice(array('choices' => array('' => '', 'Yes' => 'Yes', 'No' => 'No'))),
      'CheckNo'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'CreateDateTime'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'UpdateDateTime'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'UserId'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CasesUsers'), 'column' => 'Id')),
      'CaseNo'                   => new sfValidatorPass(array('required' => false)),
      'Description'              => new sfValidatorPass(array('required' => false)),
      'FirstTitle'               => new sfValidatorPass(array('required' => false)),
      'LastTitle'                => new sfValidatorPass(array('required' => false)),
      'ThirdParty'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CasesThirdParties'), 'column' => 'Id')),
      'BillDocumentRealName'     => new sfValidatorPass(array('required' => false)),
      'BillDocumentSystemName'   => new sfValidatorPass(array('required' => false)),
      'ActualAmount'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'CommisionPercentage'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'CommisionActual'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'ProcessingFees'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'UnderpayAdjustment'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'PayableAmount'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'PaidAmount'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'RemainToPay'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'ReceivedAmount'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'RemainToReceive'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'DifferenceAmount'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'CustomerPaidDate'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'PaymentReceivedDate'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'AgreementDate'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'Stage'                    => new sfValidatorChoice(array('required' => false, 'choices' => array('Submitted' => 'Submitted', 'Accepted' => 'Accepted', 'Paid' => 'Paid', 'Close' => 'Close'))),
      'Status'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted'))),
      'CreatedBy'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CasesUsersCreatedBy'), 'column' => 'Id')),
      'ThirdPartyBillsSubmitted' => new sfValidatorChoice(array('required' => false, 'choices' => array('Yes' => 'Yes', 'No' => 'No'))),
      'CheckNo'                  => new sfValidatorPass(array('required' => false)),
      'CreateDateTime'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'UpdateDateTime'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('cases_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cases';
  }

  public function getFields()
  {
    return array(
      'Id'                       => 'Number',
      'UserId'                   => 'ForeignKey',
      'CaseNo'                   => 'Text',
      'Description'              => 'Text',
      'FirstTitle'               => 'Text',
      'LastTitle'                => 'Text',
      'ThirdParty'               => 'ForeignKey',
      'BillDocumentRealName'     => 'Text',
      'BillDocumentSystemName'   => 'Text',
      'ActualAmount'             => 'Number',
      'CommisionPercentage'      => 'Number',
      'CommisionActual'          => 'Number',
      'ProcessingFees'           => 'Number',
      'UnderpayAdjustment'       => 'Number',
      'PayableAmount'            => 'Number',
      'PaidAmount'               => 'Number',
      'RemainToPay'              => 'Number',
      'ReceivedAmount'           => 'Number',
      'RemainToReceive'          => 'Number',
      'DifferenceAmount'         => 'Number',
      'CustomerPaidDate'         => 'Date',
      'PaymentReceivedDate'      => 'Date',
      'AgreementDate'            => 'Date',
      'Stage'                    => 'Enum',
      'Status'                   => 'Enum',
      'CreatedBy'                => 'ForeignKey',
      'ThirdPartyBillsSubmitted' => 'Enum',
      'CheckNo'                  => 'Text',
      'CreateDateTime'           => 'Date',
      'UpdateDateTime'           => 'Date',
    );
  }
}
