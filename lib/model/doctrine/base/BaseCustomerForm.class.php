<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CustomerForm', 'doctrine');

/**
 * BaseCustomerForm
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $Id
 * @property integer $UserId
 * @property string $Label
 * @property string $FieldType
 * @property string $Options
 * @property enum $Required
 * @property integer $Ordering
 * @property Doctrine_Collection $CustomerFormUsers
 * 
 * @method integer             getId()                Returns the current record's "Id" value
 * @method integer             getUserId()            Returns the current record's "UserId" value
 * @method string              getLabel()             Returns the current record's "Label" value
 * @method string              getFieldType()         Returns the current record's "FieldType" value
 * @method string              getOptions()           Returns the current record's "Options" value
 * @method enum                getRequired()          Returns the current record's "Required" value
 * @method integer             getOrdering()          Returns the current record's "Ordering" value
 * @method Doctrine_Collection getCustomerFormUsers() Returns the current record's "CustomerFormUsers" collection
 * @method CustomerForm        setId()                Sets the current record's "Id" value
 * @method CustomerForm        setUserId()            Sets the current record's "UserId" value
 * @method CustomerForm        setLabel()             Sets the current record's "Label" value
 * @method CustomerForm        setFieldType()         Sets the current record's "FieldType" value
 * @method CustomerForm        setOptions()           Sets the current record's "Options" value
 * @method CustomerForm        setRequired()          Sets the current record's "Required" value
 * @method CustomerForm        setOrdering()          Sets the current record's "Ordering" value
 * @method CustomerForm        setCustomerFormUsers() Sets the current record's "CustomerFormUsers" collection
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCustomerForm extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('CustomerForm');
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
        $this->hasColumn('Label', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('FieldType', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('Options', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('Required', 'enum', 3, array(
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
        $this->hasColumn('Ordering', 'integer', 2, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 2,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Users as CustomerFormUsers', array(
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