<?php

/**
 * AccAccseries filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccAccseriesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usagedefinition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccUsagedefinition'), 'add_empty' => true)),
      'id_isporg'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'add_empty' => true)),
      'id_systemuser'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccSystemuser'), 'add_empty' => true)),
      'crdate'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'nraccount'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'acctype'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pst_commission'     => new sfWidgetFormFilterInput(),
      'id_ispsuborg'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_usagedefinition' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccUsagedefinition'), 'column' => 'id')),
      'id_isporg'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccIsporg'), 'column' => 'id')),
      'id_systemuser'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccSystemuser'), 'column' => 'id')),
      'crdate'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'nraccount'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'acctype'            => new sfValidatorPass(array('required' => false)),
      'pst_commission'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_ispsuborg'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccIspsuborg'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('acc_accseries_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccAccseries';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'id_usagedefinition' => 'ForeignKey',
      'id_isporg'          => 'ForeignKey',
      'id_systemuser'      => 'ForeignKey',
      'crdate'             => 'Date',
      'nraccount'          => 'Number',
      'acctype'            => 'Text',
      'pst_commission'     => 'Number',
      'id_ispsuborg'       => 'ForeignKey',
    );
  }
}
