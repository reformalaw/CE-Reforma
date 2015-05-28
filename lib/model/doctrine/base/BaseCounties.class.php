<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Counties', 'doctrine');

/**
 * BaseCounties
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $Id
 * @property integer $StateId
 * @property string $Name
 * @property enum $Status
 * @property States $CountiesStates
 * @property Doctrine_Collection $CountiesUsers
 * @property Doctrine_Collection $ThirdParties
 * @property Doctrine_Collection $UserPracticeAreaLocation
 * 
 * @method integer             getId()                       Returns the current record's "Id" value
 * @method integer             getStateId()                  Returns the current record's "StateId" value
 * @method string              getName()                     Returns the current record's "Name" value
 * @method enum                getStatus()                   Returns the current record's "Status" value
 * @method States              getCountiesStates()           Returns the current record's "CountiesStates" value
 * @method Doctrine_Collection getCountiesUsers()            Returns the current record's "CountiesUsers" collection
 * @method Doctrine_Collection getThirdParties()             Returns the current record's "ThirdParties" collection
 * @method Doctrine_Collection getUserPracticeAreaLocation() Returns the current record's "UserPracticeAreaLocation" collection
 * @method Counties            setId()                       Sets the current record's "Id" value
 * @method Counties            setStateId()                  Sets the current record's "StateId" value
 * @method Counties            setName()                     Sets the current record's "Name" value
 * @method Counties            setStatus()                   Sets the current record's "Status" value
 * @method Counties            setCountiesStates()           Sets the current record's "CountiesStates" value
 * @method Counties            setCountiesUsers()            Sets the current record's "CountiesUsers" collection
 * @method Counties            setThirdParties()             Sets the current record's "ThirdParties" collection
 * @method Counties            setUserPracticeAreaLocation() Sets the current record's "UserPracticeAreaLocation" collection
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCounties extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('Counties');
        $this->hasColumn('Id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('StateId', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('Name', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('Status', 'enum', 8, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'Active',
              1 => 'Inactive',
             ),
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('States as CountiesStates', array(
             'local' => 'StateId',
             'foreign' => 'Id'));

        $this->hasMany('Users as CountiesUsers', array(
             'local' => 'Id',
             'foreign' => 'CountyId'));

        $this->hasMany('ThirdParties', array(
             'local' => 'Id',
             'foreign' => 'CountyId'));

        $this->hasMany('UserPracticeAreaLocation', array(
             'local' => 'Id',
             'foreign' => 'CountyId'));

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