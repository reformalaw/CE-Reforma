<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Cases', 'doctrine');

/**
 * BaseCases
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $Id
 * @property integer $UserId
 * @property string $CaseNo
 * @property string $Description
 * @property string $FirstTitle
 * @property string $LastTitle
 * @property integer $ThirdParty
 * @property string $BillDocumentRealName
 * @property string $BillDocumentSystemName
 * @property float $ActualAmount
 * @property float $CommisionPercentage
 * @property float $CommisionActual
 * @property float $ProcessingFees
 * @property float $UnderpayAdjustment
 * @property float $PayableAmount
 * @property float $PaidAmount
 * @property float $RemainToPay
 * @property float $ReceivedAmount
 * @property float $RemainToReceive
 * @property float $DifferenceAmount
 * @property timestamp $CustomerPaidDate
 * @property timestamp $PaymentReceivedDate
 * @property timestamp $AgreementDate
 * @property enum $Stage
 * @property enum $Status
 * @property integer $CreatedBy
 * @property enum $ThirdPartyBillsSubmitted
 * @property string $CheckNo
 * @property Users $CasesUsers
 * @property Doctrine_Collection $CasesCaseActivities
 * @property ThirdParties $CasesThirdParties
 * @property Doctrine_Collection $CasesCustomerPaymentSent
 * @property ThirdPartyPaymentReceived $CasesThirdPartyPaymentReceived
 * @property Users $CasesUsersCreatedBy
 * @property Doctrine_Collection $CaseDocuments
 * 
 * @method integer                   getId()                             Returns the current record's "Id" value
 * @method integer                   getUserId()                         Returns the current record's "UserId" value
 * @method string                    getCaseNo()                         Returns the current record's "CaseNo" value
 * @method string                    getDescription()                    Returns the current record's "Description" value
 * @method string                    getFirstTitle()                     Returns the current record's "FirstTitle" value
 * @method string                    getLastTitle()                      Returns the current record's "LastTitle" value
 * @method integer                   getThirdParty()                     Returns the current record's "ThirdParty" value
 * @method string                    getBillDocumentRealName()           Returns the current record's "BillDocumentRealName" value
 * @method string                    getBillDocumentSystemName()         Returns the current record's "BillDocumentSystemName" value
 * @method float                     getActualAmount()                   Returns the current record's "ActualAmount" value
 * @method float                     getCommisionPercentage()            Returns the current record's "CommisionPercentage" value
 * @method float                     getCommisionActual()                Returns the current record's "CommisionActual" value
 * @method float                     getProcessingFees()                 Returns the current record's "ProcessingFees" value
 * @method float                     getUnderpayAdjustment()             Returns the current record's "UnderpayAdjustment" value
 * @method float                     getPayableAmount()                  Returns the current record's "PayableAmount" value
 * @method float                     getPaidAmount()                     Returns the current record's "PaidAmount" value
 * @method float                     getRemainToPay()                    Returns the current record's "RemainToPay" value
 * @method float                     getReceivedAmount()                 Returns the current record's "ReceivedAmount" value
 * @method float                     getRemainToReceive()                Returns the current record's "RemainToReceive" value
 * @method float                     getDifferenceAmount()               Returns the current record's "DifferenceAmount" value
 * @method timestamp                 getCustomerPaidDate()               Returns the current record's "CustomerPaidDate" value
 * @method timestamp                 getPaymentReceivedDate()            Returns the current record's "PaymentReceivedDate" value
 * @method timestamp                 getAgreementDate()                  Returns the current record's "AgreementDate" value
 * @method enum                      getStage()                          Returns the current record's "Stage" value
 * @method enum                      getStatus()                         Returns the current record's "Status" value
 * @method integer                   getCreatedBy()                      Returns the current record's "CreatedBy" value
 * @method enum                      getThirdPartyBillsSubmitted()       Returns the current record's "ThirdPartyBillsSubmitted" value
 * @method string                    getCheckNo()                        Returns the current record's "CheckNo" value
 * @method Users                     getCasesUsers()                     Returns the current record's "CasesUsers" value
 * @method Doctrine_Collection       getCasesCaseActivities()            Returns the current record's "CasesCaseActivities" collection
 * @method ThirdParties              getCasesThirdParties()              Returns the current record's "CasesThirdParties" value
 * @method Doctrine_Collection       getCasesCustomerPaymentSent()       Returns the current record's "CasesCustomerPaymentSent" collection
 * @method ThirdPartyPaymentReceived getCasesThirdPartyPaymentReceived() Returns the current record's "CasesThirdPartyPaymentReceived" value
 * @method Users                     getCasesUsersCreatedBy()            Returns the current record's "CasesUsersCreatedBy" value
 * @method Doctrine_Collection       getCaseDocuments()                  Returns the current record's "CaseDocuments" collection
 * @method Cases                     setId()                             Sets the current record's "Id" value
 * @method Cases                     setUserId()                         Sets the current record's "UserId" value
 * @method Cases                     setCaseNo()                         Sets the current record's "CaseNo" value
 * @method Cases                     setDescription()                    Sets the current record's "Description" value
 * @method Cases                     setFirstTitle()                     Sets the current record's "FirstTitle" value
 * @method Cases                     setLastTitle()                      Sets the current record's "LastTitle" value
 * @method Cases                     setThirdParty()                     Sets the current record's "ThirdParty" value
 * @method Cases                     setBillDocumentRealName()           Sets the current record's "BillDocumentRealName" value
 * @method Cases                     setBillDocumentSystemName()         Sets the current record's "BillDocumentSystemName" value
 * @method Cases                     setActualAmount()                   Sets the current record's "ActualAmount" value
 * @method Cases                     setCommisionPercentage()            Sets the current record's "CommisionPercentage" value
 * @method Cases                     setCommisionActual()                Sets the current record's "CommisionActual" value
 * @method Cases                     setProcessingFees()                 Sets the current record's "ProcessingFees" value
 * @method Cases                     setUnderpayAdjustment()             Sets the current record's "UnderpayAdjustment" value
 * @method Cases                     setPayableAmount()                  Sets the current record's "PayableAmount" value
 * @method Cases                     setPaidAmount()                     Sets the current record's "PaidAmount" value
 * @method Cases                     setRemainToPay()                    Sets the current record's "RemainToPay" value
 * @method Cases                     setReceivedAmount()                 Sets the current record's "ReceivedAmount" value
 * @method Cases                     setRemainToReceive()                Sets the current record's "RemainToReceive" value
 * @method Cases                     setDifferenceAmount()               Sets the current record's "DifferenceAmount" value
 * @method Cases                     setCustomerPaidDate()               Sets the current record's "CustomerPaidDate" value
 * @method Cases                     setPaymentReceivedDate()            Sets the current record's "PaymentReceivedDate" value
 * @method Cases                     setAgreementDate()                  Sets the current record's "AgreementDate" value
 * @method Cases                     setStage()                          Sets the current record's "Stage" value
 * @method Cases                     setStatus()                         Sets the current record's "Status" value
 * @method Cases                     setCreatedBy()                      Sets the current record's "CreatedBy" value
 * @method Cases                     setThirdPartyBillsSubmitted()       Sets the current record's "ThirdPartyBillsSubmitted" value
 * @method Cases                     setCheckNo()                        Sets the current record's "CheckNo" value
 * @method Cases                     setCasesUsers()                     Sets the current record's "CasesUsers" value
 * @method Cases                     setCasesCaseActivities()            Sets the current record's "CasesCaseActivities" collection
 * @method Cases                     setCasesThirdParties()              Sets the current record's "CasesThirdParties" value
 * @method Cases                     setCasesCustomerPaymentSent()       Sets the current record's "CasesCustomerPaymentSent" collection
 * @method Cases                     setCasesThirdPartyPaymentReceived() Sets the current record's "CasesThirdPartyPaymentReceived" value
 * @method Cases                     setCasesUsersCreatedBy()            Sets the current record's "CasesUsersCreatedBy" value
 * @method Cases                     setCaseDocuments()                  Sets the current record's "CaseDocuments" collection
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCases extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('Cases');
        $this->hasColumn('Id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('UserId', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('CaseNo', 'string', 15, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 15,
             ));
        $this->hasColumn('Description', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('FirstTitle', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('LastTitle', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('ThirdParty', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('BillDocumentRealName', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('BillDocumentSystemName', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('ActualAmount', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('CommisionPercentage', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('CommisionActual', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('ProcessingFees', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('UnderpayAdjustment', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('PayableAmount', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('PaidAmount', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('RemainToPay', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('ReceivedAmount', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('RemainToReceive', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('DifferenceAmount', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('CustomerPaidDate', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('PaymentReceivedDate', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('AgreementDate', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('Stage', 'enum', 9, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'Submitted',
              1 => 'Accepted',
              2 => 'Paid',
              3 => 'Close',
             ),
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 9,
             ));
        $this->hasColumn('Status', 'enum', 8, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'Active',
              1 => 'Inactive',
              2 => 'Deleted',
             ),
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('CreatedBy', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('ThirdPartyBillsSubmitted', 'enum', 3, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'Yes',
              1 => 'No',
             ),
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 3,
             ));
        $this->hasColumn('CheckNo', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Users as CasesUsers', array(
             'local' => 'UserId',
             'foreign' => 'Id'));

        $this->hasMany('CaseActivities as CasesCaseActivities', array(
             'local' => 'Id',
             'foreign' => 'CaseId'));

        $this->hasOne('ThirdParties as CasesThirdParties', array(
             'local' => 'ThirdParty',
             'foreign' => 'Id'));

        $this->hasMany('CustomerPaymentSent as CasesCustomerPaymentSent', array(
             'local' => 'Id',
             'foreign' => 'CaseId'));

        $this->hasOne('ThirdPartyPaymentReceived as CasesThirdPartyPaymentReceived', array(
             'local' => 'Id',
             'foreign' => 'CaseId'));

        $this->hasOne('Users as CasesUsersCreatedBy', array(
             'local' => 'CreatedBy',
             'foreign' => 'Id'));

        $this->hasMany('CaseDocuments', array(
             'local' => 'Id',
             'foreign' => 'CaseId'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             'created' => 
             array(
              'name' => 'CreateDateTime',
              'type' => 'timestamp',
             ),
             'updated' => 
             array(
              'name' => 'UpdateDateTime',
              'type' => 'timestamp',
             ),
             ));
        $this->actAs($timestampable0);
    }
}