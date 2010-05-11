<?php

/**
 * Radcheck filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRadcheckFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'attr'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'op'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'value'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_accseries' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccAccseries'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'username'     => new sfValidatorPass(array('required' => false)),
      'attr'         => new sfValidatorPass(array('required' => false)),
      'op'           => new sfValidatorPass(array('required' => false)),
      'value'        => new sfValidatorPass(array('required' => false)),
      'id_accseries' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccAccseries'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('radcheck_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Radcheck';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'username'     => 'Text',
      'attr'         => 'Text',
      'op'           => 'Text',
      'value'        => 'Text',
      'id_accseries' => 'ForeignKey',
    );
  }
}
