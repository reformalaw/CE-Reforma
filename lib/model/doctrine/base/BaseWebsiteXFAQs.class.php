<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('WebsiteXFAQs', 'doctrine');

/**
 * BaseWebsiteXFAQs
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $Id
 * @property integer $FAQId
 * @property integer $WebsiteId
 * @property integer $Ordering
 * @property enum $Status
 * @property FAQs $WebsiteXFAQsFAQs
 * @property UsersWebsite $WebsiteXFAQsUsersWebsite
 * 
 * @method integer      getId()                       Returns the current record's "Id" value
 * @method integer      getFAQId()                    Returns the current record's "FAQId" value
 * @method integer      getWebsiteId()                Returns the current record's "WebsiteId" value
 * @method integer      getOrdering()                 Returns the current record's "Ordering" value
 * @method enum         getStatus()                   Returns the current record's "Status" value
 * @method FAQs         getWebsiteXFAQsFAQs()         Returns the current record's "WebsiteXFAQsFAQs" value
 * @method UsersWebsite getWebsiteXFAQsUsersWebsite() Returns the current record's "WebsiteXFAQsUsersWebsite" value
 * @method WebsiteXFAQs setId()                       Sets the current record's "Id" value
 * @method WebsiteXFAQs setFAQId()                    Sets the current record's "FAQId" value
 * @method WebsiteXFAQs setWebsiteId()                Sets the current record's "WebsiteId" value
 * @method WebsiteXFAQs setOrdering()                 Sets the current record's "Ordering" value
 * @method WebsiteXFAQs setStatus()                   Sets the current record's "Status" value
 * @method WebsiteXFAQs setWebsiteXFAQsFAQs()         Sets the current record's "WebsiteXFAQsFAQs" value
 * @method WebsiteXFAQs setWebsiteXFAQsUsersWebsite() Sets the current record's "WebsiteXFAQsUsersWebsite" value
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseWebsiteXFAQs extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('WebsiteXFAQs');
        $this->hasColumn('Id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('FAQId', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('WebsiteId', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
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
        $this->hasOne('FAQs as WebsiteXFAQsFAQs', array(
             'local' => 'FAQId',
             'foreign' => 'Id'));

        $this->hasOne('UsersWebsite as WebsiteXFAQsUsersWebsite', array(
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