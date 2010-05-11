<?php

/**
 * AccIspsuborg filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccIspsuborgFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_isporg'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'add_empty' => true)),
      'address'     => new sfWidgetFormFilterInput(),
      'city'        => new sfWidgetFormFilterInput(),
      'zipcode'     => new sfWidgetFormFilterInput(),
      'phone'       => new sfWidgetFormFilterInput(),
      'email'       => new sfWidgetFormFilterInput(),
      'contactname' => new sfWidgetFormFilterInput(),
      'radlocation' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'id_isporg'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccIsporg'), 'column' => 'id')),
      'address'     => new sfValidatorPass(array('required' => false)),
      'city'        => new sfValidatorPass(array('required' => false)),
      'zipcode'     => new sfValidatorPass(array('required' => false)),
      'phone'       => new sfValidatorPass(array('required' => false)),
      'email'       => new sfValidatorPass(array('required' => false)),
      'contactname' => new sfValidatorPass(array('required' => false)),
      'radlocation' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acc_ispsuborg_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccIspsuborg';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'name'        => 'Text',
      'id_isporg'   => 'ForeignKey',
      'address'     => 'Text',
      'city'        => 'Text',
      'zipcode'     => 'Text',
      'phone'       => 'Text',
      'email'       => 'Text',
      'contactname' => 'Text',
      'radlocation' => 'Text',
    );
  }
}
