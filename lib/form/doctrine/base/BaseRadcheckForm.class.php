<?php

/**
 * Radcheck form base class.
 *
 * @method Radcheck getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRadcheckForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'username'     => new sfWidgetFormTextarea(),
      'attr'         => new sfWidgetFormTextarea(),
      'op'           => new sfWidgetFormTextarea(),
      'value'        => new sfWidgetFormTextarea(),
      'id_accseries' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccAccseries'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'username'     => new sfValidatorString(array('required' => false)),
      'attr'         => new sfValidatorString(array('required' => false)),
      'op'           => new sfValidatorString(array('required' => false)),
      'value'        => new sfValidatorString(array('required' => false)),
      'id_accseries' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccAccseries'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('radcheck[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Radcheck';
  }

}
