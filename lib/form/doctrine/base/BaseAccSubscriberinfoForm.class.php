<?php

/**
 * AccSubscriberinfo form base class.
 *
 * @method AccSubscriberinfo getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccSubscriberinfoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'username'     => new sfWidgetFormTextarea(),
      'name'         => new sfWidgetFormTextarea(),
      'id_isporg'    => new sfWidgetFormInputText(),
      'address'      => new sfWidgetFormTextarea(),
      'city'         => new sfWidgetFormTextarea(),
      'phone'        => new sfWidgetFormTextarea(),
      'email'        => new sfWidgetFormTextarea(),
      'id_accseries' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccAccseries'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'username'     => new sfValidatorString(),
      'name'         => new sfValidatorString(array('required' => false)),
      'id_isporg'    => new sfValidatorInteger(),
      'address'      => new sfValidatorString(array('required' => false)),
      'city'         => new sfValidatorString(array('required' => false)),
      'phone'        => new sfValidatorString(array('required' => false)),
      'email'        => new sfValidatorString(array('required' => false)),
      'id_accseries' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccAccseries'))),
    ));

    $this->widgetSchema->setNameFormat('acc_subscriberinfo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccSubscriberinfo';
  }

}
