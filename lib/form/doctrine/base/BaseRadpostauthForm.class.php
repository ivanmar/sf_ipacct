<?php

/**
 * Radpostauth form base class.
 *
 * @method Radpostauth getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRadpostauthForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'username'         => new sfWidgetFormTextarea(),
      'pass'             => new sfWidgetFormTextarea(),
      'reply'            => new sfWidgetFormTextarea(),
      'calledstationid'  => new sfWidgetFormTextarea(),
      'callingstationid' => new sfWidgetFormTextarea(),
      'authdate'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'username'         => new sfValidatorString(),
      'pass'             => new sfValidatorString(array('required' => false)),
      'reply'            => new sfValidatorString(array('required' => false)),
      'calledstationid'  => new sfValidatorString(array('required' => false)),
      'callingstationid' => new sfValidatorString(array('required' => false)),
      'authdate'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('radpostauth[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Radpostauth';
  }

}
