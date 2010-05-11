<?php

/**
 * Nas form base class.
 *
 * @method Nas getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseNasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'nasname'           => new sfWidgetFormTextarea(),
      'shortname'         => new sfWidgetFormTextarea(),
      'type'              => new sfWidgetFormTextarea(),
      'ports'             => new sfWidgetFormInputText(),
      'secret'            => new sfWidgetFormTextarea(),
      'community'         => new sfWidgetFormTextarea(),
      'description'       => new sfWidgetFormTextarea(),
      'id_isporg'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'add_empty' => false)),
      'pacc_nasipaddress' => new sfWidgetFormInputText(),
      'pacc_conn_user'    => new sfWidgetFormTextarea(),
      'pacc_conn_pass'    => new sfWidgetFormTextarea(),
      'pacc_admin_user'   => new sfWidgetFormTextarea(),
      'pacc_admin_pass'   => new sfWidgetFormTextarea(),
      'id_ispsuborg'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'), 'add_empty' => true)),
      'pacc_macaddress'   => new sfWidgetFormTextarea(),
      'pacc_ssid'         => new sfWidgetFormTextarea(),
      'pacc_radlocation'  => new sfWidgetFormTextarea(),
      'pacc_adminport'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'nasname'           => new sfValidatorString(),
      'shortname'         => new sfValidatorString(),
      'type'              => new sfValidatorString(array('required' => false)),
      'ports'             => new sfValidatorInteger(array('required' => false)),
      'secret'            => new sfValidatorString(),
      'community'         => new sfValidatorString(array('required' => false)),
      'description'       => new sfValidatorString(array('required' => false)),
      'id_isporg'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'))),
      'pacc_nasipaddress' => new sfValidatorPass(array('required' => false)),
      'pacc_conn_user'    => new sfValidatorString(array('required' => false)),
      'pacc_conn_pass'    => new sfValidatorString(array('required' => false)),
      'pacc_admin_user'   => new sfValidatorString(array('required' => false)),
      'pacc_admin_pass'   => new sfValidatorString(array('required' => false)),
      'id_ispsuborg'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'), 'required' => false)),
      'pacc_macaddress'   => new sfValidatorString(array('required' => false)),
      'pacc_ssid'         => new sfValidatorString(array('required' => false)),
      'pacc_radlocation'  => new sfValidatorString(array('required' => false)),
      'pacc_adminport'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('nas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Nas';
  }

}
