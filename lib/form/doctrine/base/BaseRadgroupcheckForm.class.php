<?php

/**
 * Radgroupcheck form base class.
 *
 * @method Radgroupcheck getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRadgroupcheckForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'groupname' => new sfWidgetFormTextarea(),
      'attr'      => new sfWidgetFormTextarea(),
      'op'        => new sfWidgetFormTextarea(),
      'value'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'groupname' => new sfValidatorString(array('required' => false)),
      'attr'      => new sfValidatorString(array('required' => false)),
      'op'        => new sfValidatorString(array('required' => false)),
      'value'     => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('radgroupcheck[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Radgroupcheck';
  }

}
