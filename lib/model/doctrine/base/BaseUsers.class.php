<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Users', 'doctrine');

/**
 * BaseUsers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $Id
 * @property string $Email
 * @property string $Username
 * @property string $FirstName
 * @property string $MiddleName
 * @property string $LastName
 * @property string $Password
 * @property string $ProfilePic
 * @property string $Address1
 * @property string $Address2
 * @property string $City
 * @property integer $CountyId
 * @property integer $StateId
 * @property string $Zip
 * @property string $Phone
 * @property string $ActivationCode
 * @property enum $BillingSubscription
 * @property enum $WebsiteSubscriotion
 * @property enum $NetworkProfileSubscription
 * @property integer $DefaultState
 * @property float $UnderpayAmount
 * @property enum $UserType
 * @property enum $Status
 * @property enum $IsFeatured
 * @property integer $NoOfRating
 * @property float $AvgRating
 * @property enum $PriorityListing
 * @property timestamp $LastLoginDateTime
 * @property UserProfile $UsersUserProfile
 * @property Doctrine_Collection $UsersCases
 * @property Doctrine_Collection $UsersUserPracticeArea
 * @property Doctrine_Collection $UsersUserRoles
 * @property UsersWebsite $UsersUsersWebsite
 * @property States $UsersStates
 * @property Counties $UsersCounties
 * @property Doctrine_Collection $UsersCasesCreatedBy
 * @property Doctrine_Collection $UsersUserPracticeAreaLocation
 * @property States $States
 * @property Doctrine_Collection $CustomerPaymentSent
 * @property Doctrine_Collection $ForumTopics
 * @property Doctrine_Collection $ForumReply
 * @property CustomerContact $CustomerContact
 * @property AttorneyContact $AttorneyContact
 * @property Doctrine_Collection $ReviewRating
 * @property Doctrine_Collection $AttorneyStatistics
 * 
 * @method integer             getId()                            Returns the current record's "Id" value
 * @method string              getEmail()                         Returns the current record's "Email" value
 * @method string              getUsername()                      Returns the current record's "Username" value
 * @method string              getFirstName()                     Returns the current record's "FirstName" value
 * @method string              getMiddleName()                    Returns the current record's "MiddleName" value
 * @method string              getLastName()                      Returns the current record's "LastName" value
 * @method string              getPassword()                      Returns the current record's "Password" value
 * @method string              getProfilePic()                    Returns the current record's "ProfilePic" value
 * @method string              getAddress1()                      Returns the current record's "Address1" value
 * @method string              getAddress2()                      Returns the current record's "Address2" value
 * @method string              getCity()                          Returns the current record's "City" value
 * @method integer             getCountyId()                      Returns the current record's "CountyId" value
 * @method integer             getStateId()                       Returns the current record's "StateId" value
 * @method string              getZip()                           Returns the current record's "Zip" value
 * @method string              getPhone()                         Returns the current record's "Phone" value
 * @method string              getActivationCode()                Returns the current record's "ActivationCode" value
 * @method enum                getBillingSubscription()           Returns the current record's "BillingSubscription" value
 * @method enum                getWebsiteSubscriotion()           Returns the current record's "WebsiteSubscriotion" value
 * @method enum                getNetworkProfileSubscription()    Returns the current record's "NetworkProfileSubscription" value
 * @method integer             getDefaultState()                  Returns the current record's "DefaultState" value
 * @method float               getUnderpayAmount()                Returns the current record's "UnderpayAmount" value
 * @method enum                getUserType()                      Returns the current record's "UserType" value
 * @method enum                getStatus()                        Returns the current record's "Status" value
 * @method enum                getIsFeatured()                    Returns the current record's "IsFeatured" value
 * @method integer             getNoOfRating()                    Returns the current record's "NoOfRating" value
 * @method float               getAvgRating()                     Returns the current record's "AvgRating" value
 * @method enum                getPriorityListing()               Returns the current record's "PriorityListing" value
 * @method timestamp           getLastLoginDateTime()             Returns the current record's "LastLoginDateTime" value
 * @method UserProfile         getUsersUserProfile()              Returns the current record's "UsersUserProfile" value
 * @method Doctrine_Collection getUsersCases()                    Returns the current record's "UsersCases" collection
 * @method Doctrine_Collection getUsersUserPracticeArea()         Returns the current record's "UsersUserPracticeArea" collection
 * @method Doctrine_Collection getUsersUserRoles()                Returns the current record's "UsersUserRoles" collection
 * @method UsersWebsite        getUsersUsersWebsite()             Returns the current record's "UsersUsersWebsite" value
 * @method States              getUsersStates()                   Returns the current record's "UsersStates" value
 * @method Counties            getUsersCounties()                 Returns the current record's "UsersCounties" value
 * @method Doctrine_Collection getUsersCasesCreatedBy()           Returns the current record's "UsersCasesCreatedBy" collection
 * @method Doctrine_Collection getUsersUserPracticeAreaLocation() Returns the current record's "UsersUserPracticeAreaLocation" collection
 * @method States              getStates()                        Returns the current record's "States" value
 * @method Doctrine_Collection getCustomerPaymentSent()           Returns the current record's "CustomerPaymentSent" collection
 * @method Doctrine_Collection getForumTopics()                   Returns the current record's "ForumTopics" collection
 * @method Doctrine_Collection getForumReply()                    Returns the current record's "ForumReply" collection
 * @method CustomerContact     getCustomerContact()               Returns the current record's "CustomerContact" value
 * @method AttorneyContact     getAttorneyContact()               Returns the current record's "AttorneyContact" value
 * @method Doctrine_Collection getReviewRating()                  Returns the current record's "ReviewRating" collection
 * @method Doctrine_Collection getAttorneyStatistics()            Returns the current record's "AttorneyStatistics" collection
 * @method Users               setId()                            Sets the current record's "Id" value
 * @method Users               setEmail()                         Sets the current record's "Email" value
 * @method Users               setUsername()                      Sets the current record's "Username" value
 * @method Users               setFirstName()                     Sets the current record's "FirstName" value
 * @method Users               setMiddleName()                    Sets the current record's "MiddleName" value
 * @method Users               setLastName()                      Sets the current record's "LastName" value
 * @method Users               setPassword()                      Sets the current record's "Password" value
 * @method Users               setProfilePic()                    Sets the current record's "ProfilePic" value
 * @method Users               setAddress1()                      Sets the current record's "Address1" value
 * @method Users               setAddress2()                      Sets the current record's "Address2" value
 * @method Users               setCity()                          Sets the current record's "City" value
 * @method Users               setCountyId()                      Sets the current record's "CountyId" value
 * @method Users               setStateId()                       Sets the current record's "StateId" value
 * @method Users               setZip()                           Sets the current record's "Zip" value
 * @method Users               setPhone()                         Sets the current record's "Phone" value
 * @method Users               setActivationCode()                Sets the current record's "ActivationCode" value
 * @method Users               setBillingSubscription()           Sets the current record's "BillingSubscription" value
 * @method Users               setWebsiteSubscriotion()           Sets the current record's "WebsiteSubscriotion" value
 * @method Users               setNetworkProfileSubscription()    Sets the current record's "NetworkProfileSubscription" value
 * @method Users               setDefaultState()                  Sets the current record's "DefaultState" value
 * @method Users               setUnderpayAmount()                Sets the current record's "UnderpayAmount" value
 * @method Users               setUserType()                      Sets the current record's "UserType" value
 * @method Users               setStatus()                        Sets the current record's "Status" value
 * @method Users               setIsFeatured()                    Sets the current record's "IsFeatured" value
 * @method Users               setNoOfRating()                    Sets the current record's "NoOfRating" value
 * @method Users               setAvgRating()                     Sets the current record's "AvgRating" value
 * @method Users               setPriorityListing()               Sets the current record's "PriorityListing" value
 * @method Users               setLastLoginDateTime()             Sets the current record's "LastLoginDateTime" value
 * @method Users               setUsersUserProfile()              Sets the current record's "UsersUserProfile" value
 * @method Users               setUsersCases()                    Sets the current record's "UsersCases" collection
 * @method Users               setUsersUserPracticeArea()         Sets the current record's "UsersUserPracticeArea" collection
 * @method Users               setUsersUserRoles()                Sets the current record's "UsersUserRoles" collection
 * @method Users               setUsersUsersWebsite()             Sets the current record's "UsersUsersWebsite" value
 * @method Users               setUsersStates()                   Sets the current record's "UsersStates" value
 * @method Users               setUsersCounties()                 Sets the current record's "UsersCounties" value
 * @method Users               setUsersCasesCreatedBy()           Sets the current record's "UsersCasesCreatedBy" collection
 * @method Users               setUsersUserPracticeAreaLocation() Sets the current record's "UsersUserPracticeAreaLocation" collection
 * @method Users               setStates()                        Sets the current record's "States" value
 * @method Users               setCustomerPaymentSent()           Sets the current record's "CustomerPaymentSent" collection
 * @method Users               setForumTopics()                   Sets the current record's "ForumTopics" collection
 * @method Users               setForumReply()                    Sets the current record's "ForumReply" collection
 * @method Users               setCustomerContact()               Sets the current record's "CustomerContact" value
 * @method Users               setAttorneyContact()               Sets the current record's "AttorneyContact" value
 * @method Users               setReviewRating()                  Sets the current record's "ReviewRating" collection
 * @method Users               setAttorneyStatistics()            Sets the current record's "AttorneyStatistics" collection
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUsers extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('Users');
        $this->hasColumn('Id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('Email', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('Username', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('FirstName', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('MiddleName', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('LastName', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('Password', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('ProfilePic', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
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
        $this->hasColumn('CountyId', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
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
        $this->hasColumn('ActivationCode', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             ));
        $this->hasColumn('BillingSubscription', 'enum', 3, array(
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
        $this->hasColumn('WebsiteSubscriotion', 'enum', 3, array(
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
        $this->hasColumn('NetworkProfileSubscription', 'enum', 3, array(
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
        $this->hasColumn('DefaultState', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('UnderpayAmount', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('UserType', 'enum', 8, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => '',
              1 => 'Admin\'',
              2 => 'Staff',
              3 => 'Customer',
              4 => 'User',
             ),
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('Status', 'enum', 8, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'Active',
              1 => 'Inactive',
              2 => 'Pending',
              3 => 'Deleted',
             ),
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('IsFeatured', 'enum', 8, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'Yes',
              1 => 'No',
             ),
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('NoOfRating', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('AvgRating', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('PriorityListing', 'enum', 3, array(
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
        $this->hasColumn('LastLoginDateTime', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('UserProfile as UsersUserProfile', array(
             'local' => 'Id',
             'foreign' => 'UserId'));

        $this->hasMany('Cases as UsersCases', array(
             'local' => 'Id',
             'foreign' => 'UserId'));

        $this->hasMany('UserPracticeArea as UsersUserPracticeArea', array(
             'local' => 'Id',
             'foreign' => 'UserId'));

        $this->hasMany('UserRoles as UsersUserRoles', array(
             'local' => 'Id',
             'foreign' => 'UserId'));

        $this->hasOne('UsersWebsite as UsersUsersWebsite', array(
             'local' => 'Id',
             'foreign' => 'UserId'));

        $this->hasOne('States as UsersStates', array(
             'local' => 'StateId',
             'foreign' => 'Id'));

        $this->hasOne('Counties as UsersCounties', array(
             'local' => 'CountyId',
             'foreign' => 'Id'));

        $this->hasMany('Cases as UsersCasesCreatedBy', array(
             'local' => 'Id',
             'foreign' => 'CreatedBy'));

        $this->hasMany('UserPracticeAreaLocation as UsersUserPracticeAreaLocation', array(
             'local' => 'Id',
             'foreign' => 'UserId'));

        $this->hasOne('States', array(
             'local' => 'State',
             'foreign' => 'Id'));

        $this->hasMany('CustomerPaymentSent', array(
             'local' => 'Id',
             'foreign' => 'UserId'));

        $this->hasMany('ForumTopics', array(
             'local' => 'Id',
             'foreign' => 'UserId'));

        $this->hasMany('ForumReply', array(
             'local' => 'Id',
             'foreign' => 'UserId'));

        $this->hasOne('CustomerContact', array(
             'local' => 'Id',
             'foreign' => 'UserId'));

        $this->hasOne('AttorneyContact', array(
             'local' => 'Id',
             'foreign' => 'UserId'));

        $this->hasMany('ReviewRating', array(
             'local' => 'Id',
             'foreign' => 'UserId'));

        $this->hasMany('AttorneyStatistics', array(
             'local' => 'Id',
             'foreign' => 'UserId'));

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