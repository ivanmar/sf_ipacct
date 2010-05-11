<?php

/**
 * AccPostpaccount filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccPostpaccountFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_isporg'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'add_empty' => true)),
      'id_ispsuborg' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'), 'add_empty' => true)),
      'id_accseries' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccAccseries'), 'add_empty' => true)),
      'ind_active'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'username'     => new sfValidatorPass(array('required' => false)),
      'id_isporg'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccIsporg'), 'column' => 'id')),
      'id_ispsuborg' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccIspsuborg'), 'column' => 'id')),
      'id_accseries' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccAccseries'), 'column' => 'id')),
      'ind_active'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acc_postpaccount_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccPostpaccount';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'username'     => 'Text',
      'id_isporg'    => 'ForeignKey',
      'id_ispsuborg' => 'ForeignKey',
      'id_accseries' => 'ForeignKey',
      'ind_active'   => 'Text',
    );
  }
}
