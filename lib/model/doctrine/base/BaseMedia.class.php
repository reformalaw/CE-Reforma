<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Media', 'doctrine');

/**
 * BaseMedia
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $Id
 * @property string $Title
 * @property string $ImageName
 * @property string $OrgName
 * @property enum $Type
 * 
 * @method integer getId()        Returns the current record's "Id" value
 * @method string  getTitle()     Returns the current record's "Title" value
 * @method string  getImageName() Returns the current record's "ImageName" value
 * @method string  getOrgName()   Returns the current record's "OrgName" value
 * @method enum    getType()      Returns the current record's "Type" value
 * @method Media   setId()        Sets the current record's "Id" value
 * @method Media   setTitle()     Sets the current record's "Title" value
 * @method Media   setImageName() Sets the current record's "ImageName" value
 * @method Media   setOrgName()   Sets the current record's "OrgName" value
 * @method Media   setType()      Sets the current record's "Type" value
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMedia extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('Media');
        $this->hasColumn('Id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
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
        $this->hasColumn('ImageName', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('OrgName', 'string', 150, array(
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
              0 => 'BannerBackground',
              1 => 'BannerForeground',
              2 => 'Unsorted',
              3 => 'Logo',
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