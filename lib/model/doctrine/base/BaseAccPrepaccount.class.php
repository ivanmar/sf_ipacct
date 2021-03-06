<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('AccPrepaccount', 'doctrine');

/**
 * BaseAccPrepaccount
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $username
 * @property integer $id_accseries
 * @property integer $id_isporg
 * @property integer $id_ispsuborg
 * @property integer $id_systemuser
 * @property string $s_card
 * @property timestamp $dateissue
 * @property timestamp $datesale
 * @property timestamp $datestorn
 * @property string $ind_ondemand
 * @property timestamp $datefirstuse
 * @property timestamp $datelastuse
 * @property integer $trafficspent
 * @property decimal $nrsession
 * @property string $ind_used
 * @property integer $timespent
 * @property AccAccseries $AccAccseries
 * @property AccIsporg $AccIsporg
 * @property AccIspsuborg $AccIspsuborg
 * @property AccSystemuser $AccSystemuser
 * 
 * @method integer        getId()            Returns the current record's "id" value
 * @method string         getUsername()      Returns the current record's "username" value
 * @method integer        getIdAccseries()   Returns the current record's "id_accseries" value
 * @method integer        getIdIsporg()      Returns the current record's "id_isporg" value
 * @method integer        getIdIspsuborg()   Returns the current record's "id_ispsuborg" value
 * @method integer        getIdSystemuser()  Returns the current record's "id_systemuser" value
 * @method string         getSCard()         Returns the current record's "s_card" value
 * @method timestamp      getDateissue()     Returns the current record's "dateissue" value
 * @method timestamp      getDatesale()      Returns the current record's "datesale" value
 * @method timestamp      getDatestorn()     Returns the current record's "datestorn" value
 * @method string         getIndOndemand()   Returns the current record's "ind_ondemand" value
 * @method timestamp      getDatefirstuse()  Returns the current record's "datefirstuse" value
 * @method timestamp      getDatelastuse()   Returns the current record's "datelastuse" value
 * @method integer        getTrafficspent()  Returns the current record's "trafficspent" value
 * @method decimal        getNrsession()     Returns the current record's "nrsession" value
 * @method string         getIndUsed()       Returns the current record's "ind_used" value
 * @method integer        getTimespent()     Returns the current record's "timespent" value
 * @method AccAccseries   getAccAccseries()  Returns the current record's "AccAccseries" value
 * @method AccIsporg      getAccIsporg()     Returns the current record's "AccIsporg" value
 * @method AccIspsuborg   getAccIspsuborg()  Returns the current record's "AccIspsuborg" value
 * @method AccSystemuser  getAccSystemuser() Returns the current record's "AccSystemuser" value
 * @method AccPrepaccount setId()            Sets the current record's "id" value
 * @method AccPrepaccount setUsername()      Sets the current record's "username" value
 * @method AccPrepaccount setIdAccseries()   Sets the current record's "id_accseries" value
 * @method AccPrepaccount setIdIsporg()      Sets the current record's "id_isporg" value
 * @method AccPrepaccount setIdIspsuborg()   Sets the current record's "id_ispsuborg" value
 * @method AccPrepaccount setIdSystemuser()  Sets the current record's "id_systemuser" value
 * @method AccPrepaccount setSCard()         Sets the current record's "s_card" value
 * @method AccPrepaccount setDateissue()     Sets the current record's "dateissue" value
 * @method AccPrepaccount setDatesale()      Sets the current record's "datesale" value
 * @method AccPrepaccount setDatestorn()     Sets the current record's "datestorn" value
 * @method AccPrepaccount setIndOndemand()   Sets the current record's "ind_ondemand" value
 * @method AccPrepaccount setDatefirstuse()  Sets the current record's "datefirstuse" value
 * @method AccPrepaccount setDatelastuse()   Sets the current record's "datelastuse" value
 * @method AccPrepaccount setTrafficspent()  Sets the current record's "trafficspent" value
 * @method AccPrepaccount setNrsession()     Sets the current record's "nrsession" value
 * @method AccPrepaccount setIndUsed()       Sets the current record's "ind_used" value
 * @method AccPrepaccount setTimespent()     Sets the current record's "timespent" value
 * @method AccPrepaccount setAccAccseries()  Sets the current record's "AccAccseries" value
 * @method AccPrepaccount setAccIsporg()     Sets the current record's "AccIsporg" value
 * @method AccPrepaccount setAccIspsuborg()  Sets the current record's "AccIspsuborg" value
 * @method AccPrepaccount setAccSystemuser() Sets the current record's "AccSystemuser" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAccPrepaccount extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('acc_prepaccount');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'acc_prepaccount_id',
             'length' => 4,
             ));
        $this->hasColumn('username', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('id_accseries', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_isporg', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_ispsuborg', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_systemuser', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('s_card', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('dateissue', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('datesale', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('datestorn', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('ind_ondemand', 'string', null, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('datefirstuse', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('datelastuse', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('trafficspent', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('nrsession', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('ind_used', 'string', null, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('timespent', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 8,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('AccAccseries', array(
             'local' => 'id_accseries',
             'foreign' => 'id'));

        $this->hasOne('AccIsporg', array(
             'local' => 'id_isporg',
             'foreign' => 'id'));

        $this->hasOne('AccIspsuborg', array(
             'local' => 'id_ispsuborg',
             'foreign' => 'id'));

        $this->hasOne('AccSystemuser', array(
             'local' => 'id_systemuser',
             'foreign' => 'id'));
    }
}