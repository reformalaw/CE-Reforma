<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Permissions', 'doctrine');

/**
 * BasePermissions
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $Id
 * @property integer $PermissionCategoryId
 * @property string $UniqueKey
 * @property string $Name
 * @property Doctrine_Collection $PermissionsRolesXPermission
 * @property PermissionCategory $PermissionsPermissionCategory
 * 
 * @method integer             getId()                            Returns the current record's "Id" value
 * @method integer             getPermissionCategoryId()          Returns the current record's "PermissionCategoryId" value
 * @method string              getUniqueKey()                     Returns the current record's "UniqueKey" value
 * @method string              getName()                          Returns the current record's "Name" value
 * @method Doctrine_Collection getPermissionsRolesXPermission()   Returns the current record's "PermissionsRolesXPermission" collection
 * @method PermissionCategory  getPermissionsPermissionCategory() Returns the current record's "PermissionsPermissionCategory" value
 * @method Permissions         setId()                            Sets the current record's "Id" value
 * @method Permissions         setPermissionCategoryId()          Sets the current record's "PermissionCategoryId" value
 * @method Permissions         setUniqueKey()                     Sets the current record's "UniqueKey" value
 * @method Permissions         setName()                          Sets the current record's "Name" value
 * @method Permissions         setPermissionsRolesXPermission()   Sets the current record's "PermissionsRolesXPermission" collection
 * @method Permissions         setPermissionsPermissionCategory() Sets the current record's "PermissionsPermissionCategory" value
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePermissions extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('Permissions');
        $this->hasColumn('Id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('PermissionCategoryId', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('UniqueKey', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('Name', 'string', 50, array(
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
        $this->hasMany('RolesXPermission as PermissionsRolesXPermission', array(
             'local' => 'Id',
             'foreign' => 'PermissionId'));

        $this->hasOne('PermissionCategory as PermissionsPermissionCategory', array(
             'local' => 'PermissionCategoryId',
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