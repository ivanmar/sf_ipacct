<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('AccIspsuborg', 'doctrine');

/**
 * BaseAccIspsuborg
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property integer $id_isporg
 * @property string $address
 * @property string $city
 * @property string $zipcode
 * @property string $phone
 * @property string $email
 * @property string $contactname
 * @property string $radlocation
 * @property AccIsporg $AccIsporg
 * @property Doctrine_Collection $AccAccseries
 * @property Doctrine_Collection $AccPostpaccount
 * @property Doctrine_Collection $AccPrepaccount
 * @property Doctrine_Collection $AccSystemuser
 * @property Doctrine_Collection $Nas
 * 
 * @method integer             getId()              Returns the current record's "id" value
 * @method string              getName()            Returns the current record's "name" value
 * @method integer             getIdIsporg()        Returns the current record's "id_isporg" value
 * @method string              getAddress()         Returns the current record's "address" value
 * @method string              getCity()            Returns the current record's "city" value
 * @method string              getZipcode()         Returns the current record's "zipcode" value
 * @method string              getPhone()           Returns the current record's "phone" value
 * @method string              getEmail()           Returns the current record's "email" value
 * @method string              getContactname()     Returns the current record's "contactname" value
 * @method string              getRadlocation()     Returns the current record's "radlocation" value
 * @method AccIsporg           getAccIsporg()       Returns the current record's "AccIsporg" value
 * @method Doctrine_Collection getAccAccseries()    Returns the current record's "AccAccseries" collection
 * @method Doctrine_Collection getAccPostpaccount() Returns the current record's "AccPostpaccount" collection
 * @method Doctrine_Collection getAccPrepaccount()  Returns the current record's "AccPrepaccount" collection
 * @method Doctrine_Collection getAccSystemuser()   Returns the current record's "AccSystemuser" collection
 * @method Doctrine_Collection getNas()             Returns the current record's "Nas" collection
 * @method AccIspsuborg        setId()              Sets the current record's "id" value
 * @method AccIspsuborg        setName()            Sets the current record's "name" value
 * @method AccIspsuborg        setIdIsporg()        Sets the current record's "id_isporg" value
 * @method AccIspsuborg        setAddress()         Sets the current record's "address" value
 * @method AccIspsuborg        setCity()            Sets the current record's "city" value
 * @method AccIspsuborg        setZipcode()         Sets the current record's "zipcode" value
 * @method AccIspsuborg        setPhone()           Sets the current record's "phone" value
 * @method AccIspsuborg        setEmail()           Sets the current record's "email" value
 * @method AccIspsuborg        setContactname()     Sets the current record's "contactname" value
 * @method AccIspsuborg        setRadlocation()     Sets the current record's "radlocation" value
 * @method AccIspsuborg        setAccIsporg()       Sets the current record's "AccIsporg" value
 * @method AccIspsuborg        setAccAccseries()    Sets the current record's "AccAccseries" collection
 * @method AccIspsuborg        setAccPostpaccount() Sets the current record's "AccPostpaccount" collection
 * @method AccIspsuborg        setAccPrepaccount()  Sets the current record's "AccPrepaccount" collection
 * @method AccIspsuborg        setAccSystemuser()   Sets the current record's "AccSystemuser" collection
 * @method AccIspsuborg        setNas()             Sets the current record's "Nas" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAccIspsuborg extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('acc_ispsuborg');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'acc_ispsuborg_id',
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('id_isporg', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('address', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('city', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('zipcode', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('phone', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('email', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('contactname', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('radlocation', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('AccIsporg', array(
             'local' => 'id_isporg',
             'foreign' => 'id'));

        $this->hasMany('AccAccseries', array(
             'local' => 'id',
             'foreign' => 'id_ispsuborg'));

        $this->hasMany('AccPostpaccount', array(
             'local' => 'id',
             'foreign' => 'id_ispsuborg'));

        $this->hasMany('AccPrepaccount', array(
             'local' => 'id',
             'foreign' => 'id_ispsuborg'));

        $this->hasMany('AccSystemuser', array(
             'local' => 'id',
             'foreign' => 'id_ispsuborg'));

        $this->hasMany('Nas', array(
             'local' => 'id',
             'foreign' => 'id_ispsuborg'));
    }
}