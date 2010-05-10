<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Radgroupreply', 'doctrine');

/**
 * BaseRadgroupreply
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $groupname
 * @property string $attr
 * @property string $op
 * @property string $value
 * 
 * @method integer       getId()        Returns the current record's "id" value
 * @method string        getGroupname() Returns the current record's "groupname" value
 * @method string        getAttr()      Returns the current record's "attr" value
 * @method string        getOp()        Returns the current record's "op" value
 * @method string        getValue()     Returns the current record's "value" value
 * @method Radgroupreply setId()        Sets the current record's "id" value
 * @method Radgroupreply setGroupname() Sets the current record's "groupname" value
 * @method Radgroupreply setAttr()      Sets the current record's "attr" value
 * @method Radgroupreply setOp()        Sets the current record's "op" value
 * @method Radgroupreply setValue()     Sets the current record's "value" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRadgroupreply extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('radgroupreply');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'radgroupreply_id',
             'length' => 4,
             ));
        $this->hasColumn('groupname', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'default' => '',
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('attr', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'default' => '',
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('op', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'default' => '=',
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('value', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'default' => '',
             'primary' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}