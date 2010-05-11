<?php

/**
 * Radacct form base class.
 *
 * @method Radacct getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRadacctForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'acctsessionid'        => new sfWidgetFormTextarea(),
      'acctuniqueid'         => new sfWidgetFormTextarea(),
      'username'             => new sfWidgetFormTextarea(),
      'groupname'            => new sfWidgetFormTextarea(),
      'realm'                => new sfWidgetFormTextarea(),
      'nasipaddress'         => new sfWidgetFormInputText(),
      'nasportid'            => new sfWidgetFormTextarea(),
      'nasporttype'          => new sfWidgetFormTextarea(),
      'acctstarttime'        => new sfWidgetFormDateTime(),
      'acctstoptime'         => new sfWidgetFormDateTime(),
      'acctsessiontime'      => new sfWidgetFormInputText(),
      'acctauthentic'        => new sfWidgetFormTextarea(),
      'connectinfo_start'    => new sfWidgetFormTextarea(),
      'connectinfo_stop'     => new sfWidgetFormTextarea(),
      'acctinputoctets'      => new sfWidgetFormInputText(),
      'acctoutputoctets'     => new sfWidgetFormInputText(),
      'calledstationid'      => new sfWidgetFormTextarea(),
      'callingstationid'     => new sfWidgetFormTextarea(),
      'acctterminatecause'   => new sfWidgetFormTextarea(),
      'servicetype'          => new sfWidgetFormTextarea(),
      'framedprotocol'       => new sfWidgetFormTextarea(),
      'framedipaddress'      => new sfWidgetFormInputText(),
      'acctstartdelay'       => new sfWidgetFormInputText(),
      'acctstopdelay'        => new sfWidgetFormInputText(),
      'xascendsessionsvrkey' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'acctsessionid'        => new sfValidatorString(),
      'acctuniqueid'         => new sfValidatorString(),
      'username'             => new sfValidatorString(array('required' => false)),
      'groupname'            => new sfValidatorString(array('required' => false)),
      'realm'                => new sfValidatorString(array('required' => false)),
      'nasipaddress'         => new sfValidatorPass(),
      'nasportid'            => new sfValidatorString(array('required' => false)),
      'nasporttype'          => new sfValidatorString(array('required' => false)),
      'acctstarttime'        => new sfValidatorDateTime(array('required' => false)),
      'acctstoptime'         => new sfValidatorDateTime(array('required' => false)),
      'acctsessiontime'      => new sfValidatorInteger(array('required' => false)),
      'acctauthentic'        => new sfValidatorString(array('required' => false)),
      'connectinfo_start'    => new sfValidatorString(array('required' => false)),
      'connectinfo_stop'     => new sfValidatorString(array('required' => false)),
      'acctinputoctets'      => new sfValidatorInteger(array('required' => false)),
      'acctoutputoctets'     => new sfValidatorInteger(array('required' => false)),
      'calledstationid'      => new sfValidatorString(array('required' => false)),
      'callingstationid'     => new sfValidatorString(array('required' => false)),
      'acctterminatecause'   => new sfValidatorString(array('required' => false)),
      'servicetype'          => new sfValidatorString(array('required' => false)),
      'framedprotocol'       => new sfValidatorString(array('required' => false)),
      'framedipaddress'      => new sfValidatorPass(array('required' => false)),
      'acctstartdelay'       => new sfValidatorInteger(array('required' => false)),
      'acctstopdelay'        => new sfValidatorInteger(array('required' => false)),
      'xascendsessionsvrkey' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('radacct[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Radacct';
  }

}
