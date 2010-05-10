<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('AccIsporg', 'doctrine');

/**
 * BaseAccIsporg
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $zipcode
 * @property string $phone
 * @property string $billinginfo
 * @property string $contactname
 * @property string $email_report
 * @property string $email_nasadmin
 * @property decimal $pst_commission
 * @property string $radlocation
 * @property Doctrine_Collection $AccAccseries
 * @property Doctrine_Collection $AccIspsuborg
 * @property Doctrine_Collection $AccPostpaccount
 * @property Doctrine_Collection $AccPrepaccount
 * @property Doctrine_Collection $AccSystemuser
 * @property Doctrine_Collection $AccUsagedefinition
 * @property Doctrine_Collection $Nas
 * 
 * @method integer             getId()                 Returns the current record's "id" value
 * @method string              getName()               Returns the current record's "name" value
 * @method string              getAddress()            Returns the current record's "address" value
 * @method string              getCity()               Returns the current record's "city" value
 * @method string              getZipcode()            Returns the current record's "zipcode" value
 * @method string              getPhone()              Returns the current record's "phone" value
 * @method string              getBillinginfo()        Returns the current record's "billinginfo" value
 * @method string              getContactname()        Returns the current record's "contactname" value
 * @method string              getEmailReport()        Returns the current record's "email_report" value
 * @method string              getEmailNasadmin()      Returns the current record's "email_nasadmin" value
 * @method decimal             getPstCommission()      Returns the current record's "pst_commission" value
 * @method string              getRadlocation()        Returns the current record's "radlocation" value
 * @method Doctrine_Collection getAccAccseries()       Returns the current record's "AccAccseries" collection
 * @method Doctrine_Collection getAccIspsuborg()       Returns the current record's "AccIspsuborg" collection
 * @method Doctrine_Collection getAccPostpaccount()    Returns the current record's "AccPostpaccount" collection
 * @method Doctrine_Collection getAccPrepaccount()     Returns the current record's "AccPrepaccount" collection
 * @method Doctrine_Collection getAccSystemuser()      Returns the current record's "AccSystemuser" collection
 * @method Doctrine_Collection getAccUsagedefinition() Returns the current record's "AccUsagedefinition" collection
 * @method Doctrine_Collection getNas()                Returns the current record's "Nas" collection
 * @method AccIsporg           setId()                 Sets the current record's "id" value
 * @method AccIsporg           setName()               Sets the current record's "name" value
 * @method AccIsporg           setAddress()            Sets the current record's "address" value
 * @method AccIsporg           setCity()               Sets the current record's "city" value
 * @method AccIsporg           setZipcode()            Sets the current record's "zipcode" value
 * @method AccIsporg           setPhone()              Sets the current record's "phone" value
 * @method AccIsporg           setBillinginfo()        Sets the current record's "billinginfo" value
 * @method AccIsporg           setContactname()        Sets the current record's "contactname" value
 * @method AccIsporg           setEmailReport()        Sets the current record's "email_report" value
 * @method AccIsporg           setEmailNasadmin()      Sets the current record's "email_nasadmin" value
 * @method AccIsporg           setPstCommission()      Sets the current record's "pst_commission" value
 * @method AccIsporg           setRadlocation()        Sets the current record's "radlocation" value
 * @method AccIsporg           setAccAccseries()       Sets the current record's "AccAccseries" collection
 * @method AccIsporg           setAccIspsuborg()       Sets the current record's "AccIspsuborg" collection
 * @method AccIsporg           setAccPostpaccount()    Sets the current record's "AccPostpaccount" collection
 * @method AccIsporg           setAccPrepaccount()     Sets the current record's "AccPrepaccount" collection
 * @method AccIsporg           setAccSystemuser()      Sets the current record's "AccSystemuser" collection
 * @method AccIsporg           setAccUsagedefinition() Sets the current record's "AccUsagedefinition" collection
 * @method AccIsporg           setNas()                Sets the current record's "Nas" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAccIsporg extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('acc_isporg');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'acc_isporg_id',
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
        $this->hasColumn('billinginfo', 'string', null, array(
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
        $this->hasColumn('email_report', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('email_nasadmin', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('pst_commission', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'default' => '0',
             'primary' => false,
             'length' => 18,
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
        $this->hasMany('AccAccseries', array(
             'local' => 'id',
             'foreign' => 'id_isporg'));

        $this->hasMany('AccIspsuborg', array(
             'local' => 'id',
             'foreign' => 'id_isporg'));

        $this->hasMany('AccPostpaccount', array(
             'local' => 'id',
             'foreign' => 'id_isporg'));

        $this->hasMany('AccPrepaccount', array(
             'local' => 'id',
             'foreign' => 'id_isporg'));

        $this->hasMany('AccSystemuser', array(
             'local' => 'id',
             'foreign' => 'id_isporg'));

        $this->hasMany('AccUsagedefinition', array(
             'local' => 'id',
             'foreign' => 'id_isporg'));

        $this->hasMany('Nas', array(
             'local' => 'id',
             'foreign' => 'id_isporg'));
    }
}