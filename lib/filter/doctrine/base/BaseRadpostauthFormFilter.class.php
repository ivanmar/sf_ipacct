<?php

/**
 * Radpostauth filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRadpostauthFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pass'             => new sfWidgetFormFilterInput(),
      'reply'            => new sfWidgetFormFilterInput(),
      'calledstationid'  => new sfWidgetFormFilterInput(),
      'callingstationid' => new sfWidgetFormFilterInput(),
      'authdate'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'username'         => new sfValidatorPass(array('required' => false)),
      'pass'             => new sfValidatorPass(array('required' => false)),
      'reply'            => new sfValidatorPass(array('required' => false)),
      'calledstationid'  => new sfValidatorPass(array('required' => false)),
      'callingstationid' => new sfValidatorPass(array('required' => false)),
      'authdate'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('radpostauth_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Radpostauth';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'username'         => 'Text',
      'pass'             => 'Text',
      'reply'            => 'Text',
      'calledstationid'  => 'Text',
      'callingstationid' => 'Text',
      'authdate'         => 'Date',
    );
  }
}
