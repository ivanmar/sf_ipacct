<?php

/**
 * AccPostpaccountlog filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccPostpaccountlogFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_postpaccount'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccPostpaccount'), 'add_empty' => true)),
      'srvstarttime'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'srvstoptime'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'timespent'          => new sfWidgetFormFilterInput(),
      'trafficspent'       => new sfWidgetFormFilterInput(),
      'id_systemuser'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccSystemuser'), 'add_empty' => true)),
      's_bill'             => new sfWidgetFormFilterInput(),
      'accountinfo'        => new sfWidgetFormFilterInput(),
      'id_usagedefinition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccUsagedefinition'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_postpaccount'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccPostpaccount'), 'column' => 'id')),
      'srvstarttime'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'srvstoptime'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'timespent'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'trafficspent'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_systemuser'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccSystemuser'), 'column' => 'id')),
      's_bill'             => new sfValidatorPass(array('required' => false)),
      'accountinfo'        => new sfValidatorPass(array('required' => false)),
      'id_usagedefinition' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccUsagedefinition'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('acc_postpaccountlog_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccPostpaccountlog';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'id_postpaccount'    => 'ForeignKey',
      'srvstarttime'       => 'Date',
      'srvstoptime'        => 'Date',
      'timespent'          => 'Number',
      'trafficspent'       => 'Number',
      'id_systemuser'      => 'ForeignKey',
      's_bill'             => 'Text',
      'accountinfo'        => 'Text',
      'id_usagedefinition' => 'ForeignKey',
    );
  }
}
