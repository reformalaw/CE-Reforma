<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('SiteEmails', 'doctrine');

/**
 * BaseSiteEmails
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $Id
 * @property string $Subject
 * @property string $MessageBody
 * 
 * @method string     getId()          Returns the current record's "Id" value
 * @method string     getSubject()     Returns the current record's "Subject" value
 * @method string     getMessageBody() Returns the current record's "MessageBody" value
 * @method SiteEmails setId()          Sets the current record's "Id" value
 * @method SiteEmails setSubject()     Sets the current record's "Subject" value
 * @method SiteEmails setMessageBody() Sets the current record's "MessageBody" value
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSiteEmails extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('SiteEmails');
        $this->hasColumn('Id', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('Subject', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('MessageBody', 'string', null, array(
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