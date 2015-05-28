<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CustomerPaymentSent', 'doctrine');

/**
 * BaseCustomerPaymentSent
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $Id
 * @property integer $UserId
 * @property string $CaseNo
 * @property integer $CaseId
 * @property float $ActualAmount
 * @property float $CommisionPercentage
 * @property float $CommisionActual
 * @property float $ProcessingFees
 * @property float $UnderpayAdjustment
 * @property float $PayableAmount
 * @property timestamp $CustomerPaidDate
 * @property string $CheckNo
 * @property string $Description
 * @property Cases $CustomerPaymentSentCases
 * @property Users $CustomerPaymentSentUsers
 * 
 * @method integer             getId()                       Returns the current record's "Id" value
 * @method integer             getUserId()                   Returns the current record's "UserId" value
 * @method string              getCaseNo()                   Returns the current record's "CaseNo" value
 * @method integer             getCaseId()                   Returns the current record's "CaseId" value
 * @method float               getActualAmount()             Returns the current record's "ActualAmount" value
 * @method float               getCommisionPercentage()      Returns the current record's "CommisionPercentage" value
 * @method float               getCommisionActual()          Returns the current record's "CommisionActual" value
 * @method float               getProcessingFees()           Returns the current record's "ProcessingFees" value
 * @method float               getUnderpayAdjustment()       Returns the current record's "UnderpayAdjustment" value
 * @method float               getPayableAmount()            Returns the current record's "PayableAmount" value
 * @method timestamp           getCustomerPaidDate()         Returns the current record's "CustomerPaidDate" value
 * @method string              getCheckNo()                  Returns the current record's "CheckNo" value
 * @method string              getDescription()              Returns the current record's "Description" value
 * @method Cases               getCustomerPaymentSentCases() Returns the current record's "CustomerPaymentSentCases" value
 * @method Users               getCustomerPaymentSentUsers() Returns the current record's "CustomerPaymentSentUsers" value
 * @method CustomerPaymentSent setId()                       Sets the current record's "Id" value
 * @method CustomerPaymentSent setUserId()                   Sets the current record's "UserId" value
 * @method CustomerPaymentSent setCaseNo()                   Sets the current record's "CaseNo" value
 * @method CustomerPaymentSent setCaseId()                   Sets the current record's "CaseId" value
 * @method CustomerPaymentSent setActualAmount()             Sets the current record's "ActualAmount" value
 * @method CustomerPaymentSent setCommisionPercentage()      Sets the current record's "CommisionPercentage" value
 * @method CustomerPaymentSent setCommisionActual()          Sets the current record's "CommisionActual" value
 * @method CustomerPaymentSent setProcessingFees()           Sets the current record's "ProcessingFees" value
 * @method CustomerPaymentSent setUnderpayAdjustment()       Sets the current record's "UnderpayAdjustment" value
 * @method CustomerPaymentSent setPayableAmount()            Sets the current record's "PayableAmount" value
 * @method CustomerPaymentSent setCustomerPaidDate()         Sets the current record's "CustomerPaidDate" value
 * @method CustomerPaymentSent setCheckNo()                  Sets the current record's "CheckNo" value
 * @method CustomerPaymentSent setDescription()              Sets the current record's "Description" value
 * @method CustomerPaymentSent setCustomerPaymentSentCases() Sets the current record's "CustomerPaymentSentCases" value
 * @method CustomerPaymentSent setCustomerPaymentSentUsers() Sets the current record's "CustomerPaymentSentUsers" value
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCustomerPaymentSent extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('CustomerPaymentSent');
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
        $this->hasColumn('CaseId', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
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
        $this->hasColumn('CustomerPaidDate', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
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
        $this->hasColumn('Description', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cases as CustomerPaymentSentCases', array(
             'local' => 'CaseId',
             'foreign' => 'Id'));

        $this->hasOne('Users as CustomerPaymentSentUsers', array(
             'local' => 'UserId',
             'foreign' => 'Id'));

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