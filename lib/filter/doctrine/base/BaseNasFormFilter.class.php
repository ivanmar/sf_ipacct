<?php

/**
 * Nas filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseNasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nasname'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'shortname'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ports'             => new sfWidgetFormFilterInput(),
      'secret'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'community'         => new sfWidgetFormFilterInput(),
      'description'       => new sfWidgetFormFilterInput(),
      'id_isporg'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'add_empty' => true)),
      'pacc_nasipaddress' => new sfWidgetFormFilterInput(),
      'pacc_conn_user'    => new sfWidgetFormFilterInput(),
      'pacc_conn_pass'    => new sfWidgetFormFilterInput(),
      'pacc_admin_user'   => new sfWidgetFormFilterInput(),
      'pacc_admin_pass'   => new sfWidgetFormFilterInput(),
      'id_ispsuborg'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'), 'add_empty' => true)),
      'pacc_macaddress'   => new sfWidgetFormFilterInput(),
      'pacc_ssid'         => new sfWidgetFormFilterInput(),
      'pacc_radlocation'  => new sfWidgetFormFilterInput(),
      'pacc_adminport'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nasname'           => new sfValidatorPass(array('required' => false)),
      'shortname'         => new sfValidatorPass(array('required' => false)),
      'type'              => new sfValidatorPass(array('required' => false)),
      'ports'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'secret'            => new sfValidatorPass(array('required' => false)),
      'community'         => new sfValidatorPass(array('required' => false)),
      'description'       => new sfValidatorPass(array('required' => false)),
      'id_isporg'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccIsporg'), 'column' => 'id')),
      'pacc_nasipaddress' => new sfValidatorPass(array('required' => false)),
      'pacc_conn_user'    => new sfValidatorPass(array('required' => false)),
      'pacc_conn_pass'    => new sfValidatorPass(array('required' => false)),
      'pacc_admin_user'   => new sfValidatorPass(array('required' => false)),
      'pacc_admin_pass'   => new sfValidatorPass(array('required' => false)),
      'id_ispsuborg'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccIspsuborg'), 'column' => 'id')),
      'pacc_macaddress'   => new sfValidatorPass(array('required' => false)),
      'pacc_ssid'         => new sfValidatorPass(array('required' => false)),
      'pacc_radlocation'  => new sfValidatorPass(array('required' => false)),
      'pacc_adminport'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('nas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Nas';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'nasname'           => 'Text',
      'shortname'         => 'Text',
      'type'              => 'Text',
      'ports'             => 'Number',
      'secret'            => 'Text',
      'community'         => 'Text',
      'description'       => 'Text',
      'id_isporg'         => 'ForeignKey',
      'pacc_nasipaddress' => 'Text',
      'pacc_conn_user'    => 'Text',
      'pacc_conn_pass'    => 'Text',
      'pacc_admin_user'   => 'Text',
      'pacc_admin_pass'   => 'Text',
      'id_ispsuborg'      => 'ForeignKey',
      'pacc_macaddress'   => 'Text',
      'pacc_ssid'         => 'Text',
      'pacc_radlocation'  => 'Text',
      'pacc_adminport'    => 'Number',
    );
  }
}
