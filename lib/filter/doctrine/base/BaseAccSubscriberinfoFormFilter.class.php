<?php

/**
 * AccSubscriberinfo filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccSubscriberinfoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'         => new sfWidgetFormFilterInput(),
      'id_isporg'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'address'      => new sfWidgetFormFilterInput(),
      'city'         => new sfWidgetFormFilterInput(),
      'phone'        => new sfWidgetFormFilterInput(),
      'email'        => new sfWidgetFormFilterInput(),
      'id_accseries' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccAccseries'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'username'     => new sfValidatorPass(array('required' => false)),
      'name'         => new sfValidatorPass(array('required' => false)),
      'id_isporg'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'address'      => new sfValidatorPass(array('required' => false)),
      'city'         => new sfValidatorPass(array('required' => false)),
      'phone'        => new sfValidatorPass(array('required' => false)),
      'email'        => new sfValidatorPass(array('required' => false)),
      'id_accseries' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccAccseries'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('acc_subscriberinfo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccSubscriberinfo';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'username'     => 'Text',
      'name'         => 'Text',
      'id_isporg'    => 'Number',
      'address'      => 'Text',
      'city'         => 'Text',
      'phone'        => 'Text',
      'email'        => 'Text',
      'id_accseries' => 'ForeignKey',
    );
  }
}
