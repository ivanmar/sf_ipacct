<?php

/**
 * AccPrepaccount filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccPrepaccountFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_accseries'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccAccseries'), 'add_empty' => true)),
      'id_isporg'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'add_empty' => true)),
      'id_ispsuborg'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'), 'add_empty' => true)),
      'id_systemuser' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccSystemuser'), 'add_empty' => true)),
      's_card'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dateissue'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datesale'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datestorn'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ind_ondemand'  => new sfWidgetFormFilterInput(),
      'datefirstuse'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datelastuse'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'trafficspent'  => new sfWidgetFormFilterInput(),
      'nrsession'     => new sfWidgetFormFilterInput(),
      'ind_used'      => new sfWidgetFormFilterInput(),
      'timespent'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'username'      => new sfValidatorPass(array('required' => false)),
      'id_accseries'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccAccseries'), 'column' => 'id')),
      'id_isporg'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccIsporg'), 'column' => 'id')),
      'id_ispsuborg'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccIspsuborg'), 'column' => 'id')),
      'id_systemuser' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccSystemuser'), 'column' => 'id')),
      's_card'        => new sfValidatorPass(array('required' => false)),
      'dateissue'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'datesale'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'datestorn'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ind_ondemand'  => new sfValidatorPass(array('required' => false)),
      'datefirstuse'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'datelastuse'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'trafficspent'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nrsession'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'ind_used'      => new sfValidatorPass(array('required' => false)),
      'timespent'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('acc_prepaccount_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccPrepaccount';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'username'      => 'Text',
      'id_accseries'  => 'ForeignKey',
      'id_isporg'     => 'ForeignKey',
      'id_ispsuborg'  => 'ForeignKey',
      'id_systemuser' => 'ForeignKey',
      's_card'        => 'Text',
      'dateissue'     => 'Date',
      'datesale'      => 'Date',
      'datestorn'     => 'Date',
      'ind_ondemand'  => 'Text',
      'datefirstuse'  => 'Date',
      'datelastuse'   => 'Date',
      'trafficspent'  => 'Number',
      'nrsession'     => 'Number',
      'ind_used'      => 'Text',
      'timespent'     => 'Number',
    );
  }
}
