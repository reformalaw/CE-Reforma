<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ReviewRating', 'doctrine');

/**
 * BaseReviewRating
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $Id
 * @property integer $UserId
 * @property integer $CustomerId
 * @property integer $Rate
 * @property string $Review
 * @property enum $Spam
 * @property enum $Status
 * @property Users $ReviewRatingUsers
 * @property Users $ReviewRatingCustomers
 * 
 * @method integer      getId()                    Returns the current record's "Id" value
 * @method integer      getUserId()                Returns the current record's "UserId" value
 * @method integer      getCustomerId()            Returns the current record's "CustomerId" value
 * @method integer      getRate()                  Returns the current record's "Rate" value
 * @method string       getReview()                Returns the current record's "Review" value
 * @method enum         getSpam()                  Returns the current record's "Spam" value
 * @method enum         getStatus()                Returns the current record's "Status" value
 * @method Users        getReviewRatingUsers()     Returns the current record's "ReviewRatingUsers" value
 * @method Users        getReviewRatingCustomers() Returns the current record's "ReviewRatingCustomers" value
 * @method ReviewRating setId()                    Sets the current record's "Id" value
 * @method ReviewRating setUserId()                Sets the current record's "UserId" value
 * @method ReviewRating setCustomerId()            Sets the current record's "CustomerId" value
 * @method ReviewRating setRate()                  Sets the current record's "Rate" value
 * @method ReviewRating setReview()                Sets the current record's "Review" value
 * @method ReviewRating setSpam()                  Sets the current record's "Spam" value
 * @method ReviewRating setStatus()                Sets the current record's "Status" value
 * @method ReviewRating setReviewRatingUsers()     Sets the current record's "ReviewRatingUsers" value
 * @method ReviewRating setReviewRatingCustomers() Sets the current record's "ReviewRatingCustomers" value
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseReviewRating extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ReviewRating');
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
        $this->hasColumn('CustomerId', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('Rate', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('Review', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('Spam', 'enum', 3, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => '0',
              1 => '1',
             ),
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 3,
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
        $this->hasOne('Users as ReviewRatingUsers', array(
             'local' => 'UserId',
             'foreign' => 'Id'));

        $this->hasOne('Users as ReviewRatingCustomers', array(
             'local' => 'CustomerId',
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