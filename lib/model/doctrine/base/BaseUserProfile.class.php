<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('UserProfile', 'doctrine');

/**
 * BaseUserProfile
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $Id
 * @property integer $UserId
 * @property string $FirmName
 * @property string $Address1
 * @property string $Address2
 * @property string $City
 * @property integer $StateId
 * @property string $Zip
 * @property string $Phone
 * @property string $Summary
 * @property string $FeesInformation
 * @property enum $FreeConsultation
 * @property Doctrine_Collection $UserProfileUsers
 * @property States $UserProfileStates
 * @property Doctrine_Collection $UserProfileUserPracticeAreaLocation
 * @property States $States
 * 
 * @method integer             getId()                                  Returns the current record's "Id" value
 * @method integer             getUserId()                              Returns the current record's "UserId" value
 * @method string              getFirmName()                            Returns the current record's "FirmName" value
 * @method string              getAddress1()                            Returns the current record's "Address1" value
 * @method string              getAddress2()                            Returns the current record's "Address2" value
 * @method string              getCity()                                Returns the current record's "City" value
 * @method integer             getStateId()                             Returns the current record's "StateId" value
 * @method string              getZip()                                 Returns the current record's "Zip" value
 * @method string              getPhone()                               Returns the current record's "Phone" value
 * @method string              getSummary()                             Returns the current record's "Summary" value
 * @method string              getFeesInformation()                     Returns the current record's "FeesInformation" value
 * @method enum                getFreeConsultation()                    Returns the current record's "FreeConsultation" value
 * @method Doctrine_Collection getUserProfileUsers()                    Returns the current record's "UserProfileUsers" collection
 * @method States              getUserProfileStates()                   Returns the current record's "UserProfileStates" value
 * @method Doctrine_Collection getUserProfileUserPracticeAreaLocation() Returns the current record's "UserProfileUserPracticeAreaLocation" collection
 * @method States              getStates()                              Returns the current record's "States" value
 * @method UserProfile         setId()                                  Sets the current record's "Id" value
 * @method UserProfile         setUserId()                              Sets the current record's "UserId" value
 * @method UserProfile         setFirmName()                            Sets the current record's "FirmName" value
 * @method UserProfile         setAddress1()                            Sets the current record's "Address1" value
 * @method UserProfile         setAddress2()                            Sets the current record's "Address2" value
 * @method UserProfile         setCity()                                Sets the current record's "City" value
 * @method UserProfile         setStateId()                             Sets the current record's "StateId" value
 * @method UserProfile         setZip()                                 Sets the current record's "Zip" value
 * @method UserProfile         setPhone()                               Sets the current record's "Phone" value
 * @method UserProfile         setSummary()                             Sets the current record's "Summary" value
 * @method UserProfile         setFeesInformation()                     Sets the current record's "FeesInformation" value
 * @method UserProfile         setFreeConsultation()                    Sets the current record's "FreeConsultation" value
 * @method UserProfile         setUserProfileUsers()                    Sets the current record's "UserProfileUsers" collection
 * @method UserProfile         setUserProfileStates()                   Sets the current record's "UserProfileStates" value
 * @method UserProfile         setUserProfileUserPracticeAreaLocation() Sets the current record's "UserProfileUserPracticeAreaLocation" collection
 * @method UserProfile         setStates()                              Sets the current record's "States" value
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUserProfile extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('UserProfile');
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
        $this->hasColumn('FirmName', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('Address1', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('Address2', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('City', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
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
        $this->hasColumn('Zip', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             ));
        $this->hasColumn('Phone', 'string', 20, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('Summary', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('FeesInformation', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('FreeConsultation', 'enum', 3, array(
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Users as UserProfileUsers', array(
             'local' => 'UserId',
             'foreign' => 'Id'));

        $this->hasOne('States as UserProfileStates', array(
             'local' => 'StateId',
             'foreign' => 'Id'));

        $this->hasMany('UserPracticeAreaLocation as UserProfileUserPracticeAreaLocation', array(
             'local' => 'UserId',
             'foreign' => 'UserId'));

        $this->hasOne('States', array(
             'local' => 'State',
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