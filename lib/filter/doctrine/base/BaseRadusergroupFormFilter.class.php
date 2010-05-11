<?php

/**
 * Radusergroup filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRadusergroupFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'groupname' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'priority'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'username'  => new sfValidatorPass(array('required' => false)),
      'groupname' => new sfValidatorPass(array('required' => false)),
      'priority'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('radusergroup_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Radusergroup';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'username'  => 'Text',
      'groupname' => 'Text',
      'priority'  => 'Number',
    );
  }
}
