<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CMSPages', 'doctrine');

/**
 * BaseCMSPages
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $Id
 * @property integer $WebsiteId
 * @property string $Title
 * @property string $SubTitle
 * @property string $MetaTitle
 * @property string $MetaKeywords
 * @property string $MetaDescription
 * @property string $Content
 * @property enum $Template
 * @property enum $Status
 * @property enum $Type
 * @property string $UniqueKey
 * @property string $Slug
 * @property UsersWebsite $CMSPagesUserWebsite
 * @property Doctrine_Collection $WebsiteMenu
 * 
 * @method integer             getId()                  Returns the current record's "Id" value
 * @method integer             getWebsiteId()           Returns the current record's "WebsiteId" value
 * @method string              getTitle()               Returns the current record's "Title" value
 * @method string              getSubTitle()            Returns the current record's "SubTitle" value
 * @method string              getMetaTitle()           Returns the current record's "MetaTitle" value
 * @method string              getMetaKeywords()        Returns the current record's "MetaKeywords" value
 * @method string              getMetaDescription()     Returns the current record's "MetaDescription" value
 * @method string              getContent()             Returns the current record's "Content" value
 * @method enum                getTemplate()            Returns the current record's "Template" value
 * @method enum                getStatus()              Returns the current record's "Status" value
 * @method enum                getType()                Returns the current record's "Type" value
 * @method string              getUniqueKey()           Returns the current record's "UniqueKey" value
 * @method string              getSlug()                Returns the current record's "Slug" value
 * @method UsersWebsite        getCMSPagesUserWebsite() Returns the current record's "CMSPagesUserWebsite" value
 * @method Doctrine_Collection getWebsiteMenu()         Returns the current record's "WebsiteMenu" collection
 * @method CMSPages            setId()                  Sets the current record's "Id" value
 * @method CMSPages            setWebsiteId()           Sets the current record's "WebsiteId" value
 * @method CMSPages            setTitle()               Sets the current record's "Title" value
 * @method CMSPages            setSubTitle()            Sets the current record's "SubTitle" value
 * @method CMSPages            setMetaTitle()           Sets the current record's "MetaTitle" value
 * @method CMSPages            setMetaKeywords()        Sets the current record's "MetaKeywords" value
 * @method CMSPages            setMetaDescription()     Sets the current record's "MetaDescription" value
 * @method CMSPages            setContent()             Sets the current record's "Content" value
 * @method CMSPages            setTemplate()            Sets the current record's "Template" value
 * @method CMSPages            setStatus()              Sets the current record's "Status" value
 * @method CMSPages            setType()                Sets the current record's "Type" value
 * @method CMSPages            setUniqueKey()           Sets the current record's "UniqueKey" value
 * @method CMSPages            setSlug()                Sets the current record's "Slug" value
 * @method CMSPages            setCMSPagesUserWebsite() Sets the current record's "CMSPagesUserWebsite" value
 * @method CMSPages            setWebsiteMenu()         Sets the current record's "WebsiteMenu" collection
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCMSPages extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('CMSPages');
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
        $this->hasColumn('Title', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('SubTitle', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('MetaTitle', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('MetaKeywords', 'string', 250, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 250,
             ));
        $this->hasColumn('MetaDescription', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('Content', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('Template', 'enum', 8, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'column1',
              1 => 'column2L',
              2 => 'column2R',
              3 => 'home',
              4 => 'default',
             ),
             'primary' => false,
             'notnull' => true,
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
              2 => 'Deleted',
             ),
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('Type', 'enum', 8, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'Static',
              1 => 'Dynamic',
             ),
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('UniqueKey', 'string', 150, array(
             'type' => 'string',
             'length' => 150,
             ));
        $this->hasColumn('Slug', 'string', 150, array(
             'type' => 'string',
             'length' => 150,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('UsersWebsite as CMSPagesUserWebsite', array(
             'local' => 'WebsiteId',
             'foreign' => 'Id'));

        $this->hasMany('WebsiteMenu', array(
             'local' => 'Id',
             'foreign' => 'CmsPageId'));

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