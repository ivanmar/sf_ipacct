<?php

/**
 * AccSystemuser filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccSystemuserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pass'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'acctype'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_isporg'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'add_empty' => true)),
      'id_ispsuborg' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'), 'add_empty' => true)),
      'name'         => new sfWidgetFormFilterInput(),
      'email'        => new sfWidgetFormFilterInput(),
      'phone'        => new sfWidgetFormFilterInput(),
      'mobile'       => new sfWidgetFormFilterInput(),
      'lang'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'username'     => new sfValidatorPass(array('required' => false)),
      'pass'         => new sfValidatorPass(array('required' => false)),
      'acctype'      => new sfValidatorPass(array('required' => false)),
      'id_isporg'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccIsporg'), 'column' => 'id')),
      'id_ispsuborg' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccIspsuborg'), 'column' => 'id')),
      'name'         => new sfValidatorPass(array('required' => false)),
      'email'        => new sfValidatorPass(array('required' => false)),
      'phone'        => new sfValidatorPass(array('required' => false)),
      'mobile'       => new sfValidatorPass(array('required' => false)),
      'lang'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acc_systemuser_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccSystemuser';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'username'     => 'Text',
      'pass'         => 'Text',
      'acctype'      => 'Text',
      'id_isporg'    => 'ForeignKey',
      'id_ispsuborg' => 'ForeignKey',
      'name'         => 'Text',
      'email'        => 'Text',
      'phone'        => 'Text',
      'mobile'       => 'Text',
      'lang'         => 'Text',
    );
  }
}
