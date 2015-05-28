<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('WebsiteMenu', 'doctrine');

/**
 * BaseWebsiteMenu
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $Id
 * @property integer $WebsiteId
 * @property integer $CmsPageId
 * @property integer $WebsitePracticeAreaId
 * @property integer $ParentId
 * @property string $Title
 * @property enum $Type
 * @property enum $MenuType
 * @property integer $Ordering
 * @property CMSPages $WebsiteMenuCMSPages
 * @property WebsitePracticeArea $WebsiteMenuWebsitePracticeArea
 * @property UsersWebsite $WebsiteMenuUsersWebsite
 * 
 * @method integer             getId()                             Returns the current record's "Id" value
 * @method integer             getWebsiteId()                      Returns the current record's "WebsiteId" value
 * @method integer             getCmsPageId()                      Returns the current record's "CmsPageId" value
 * @method integer             getWebsitePracticeAreaId()          Returns the current record's "WebsitePracticeAreaId" value
 * @method integer             getParentId()                       Returns the current record's "ParentId" value
 * @method string              getTitle()                          Returns the current record's "Title" value
 * @method enum                getType()                           Returns the current record's "Type" value
 * @method enum                getMenuType()                       Returns the current record's "MenuType" value
 * @method integer             getOrdering()                       Returns the current record's "Ordering" value
 * @method CMSPages            getWebsiteMenuCMSPages()            Returns the current record's "WebsiteMenuCMSPages" value
 * @method WebsitePracticeArea getWebsiteMenuWebsitePracticeArea() Returns the current record's "WebsiteMenuWebsitePracticeArea" value
 * @method UsersWebsite        getWebsiteMenuUsersWebsite()        Returns the current record's "WebsiteMenuUsersWebsite" value
 * @method WebsiteMenu         setId()                             Sets the current record's "Id" value
 * @method WebsiteMenu         setWebsiteId()                      Sets the current record's "WebsiteId" value
 * @method WebsiteMenu         setCmsPageId()                      Sets the current record's "CmsPageId" value
 * @method WebsiteMenu         setWebsitePracticeAreaId()          Sets the current record's "WebsitePracticeAreaId" value
 * @method WebsiteMenu         setParentId()                       Sets the current record's "ParentId" value
 * @method WebsiteMenu         setTitle()                          Sets the current record's "Title" value
 * @method WebsiteMenu         setType()                           Sets the current record's "Type" value
 * @method WebsiteMenu         setMenuType()                       Sets the current record's "MenuType" value
 * @method WebsiteMenu         setOrdering()                       Sets the current record's "Ordering" value
 * @method WebsiteMenu         setWebsiteMenuCMSPages()            Sets the current record's "WebsiteMenuCMSPages" value
 * @method WebsiteMenu         setWebsiteMenuWebsitePracticeArea() Sets the current record's "WebsiteMenuWebsitePracticeArea" value
 * @method WebsiteMenu         setWebsiteMenuUsersWebsite()        Sets the current record's "WebsiteMenuUsersWebsite" value
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseWebsiteMenu extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('WebsiteMenu');
        $this->hasColumn('Id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('WebsiteId', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('CmsPageId', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('WebsitePracticeAreaId', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('ParentId', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('Title', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('Type', 'enum', 8, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => 1,
              1 => 2,
              2 => 3,
             ),
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('MenuType', 'enum', 8, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'Header',
              1 => 'Footer',
             ),
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
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
        $this->hasOne('CMSPages as WebsiteMenuCMSPages', array(
             'local' => 'CmsPageId',
             'foreign' => 'Id'));

        $this->hasOne('WebsitePracticeArea as WebsiteMenuWebsitePracticeArea', array(
             'local' => 'WebsitePracticeAreaId',
             'foreign' => 'Id'));

        $this->hasOne('UsersWebsite as WebsiteMenuUsersWebsite', array(
             'local' => 'WebsiteId',
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