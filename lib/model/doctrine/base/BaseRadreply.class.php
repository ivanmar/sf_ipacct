<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Radreply', 'doctrine');

/**
 * BaseRadreply
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $username
 * @property string $attr
 * @property string $op
 * @property string $value
 * 
 * @method integer  getId()       Returns the current record's "id" value
 * @method string   getUsername() Returns the current record's "username" value
 * @method string   getAttr()     Returns the current record's "attr" value
 * @method string   getOp()       Returns the current record's "op" value
 * @method string   getValue()    Returns the current record's "value" value
 * @method Radreply setId()       Sets the current record's "id" value
 * @method Radreply setUsername() Sets the current record's "username" value
 * @method Radreply setAttr()     Sets the current record's "attr" value
 * @method Radreply setOp()       Sets the current record's "op" value
 * @method Radreply setValue()    Sets the current record's "value" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRadreply extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('radreply');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'radreply_id',
             'length' => 4,
             ));
        $this->hasColumn('username', 'string', null, array(
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