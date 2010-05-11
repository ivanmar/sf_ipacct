<?php

/**
 * AccIspsuborg form base class.
 *
 * @method AccIspsuborg getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccIspsuborgForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormTextarea(),
      'id_isporg'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'add_empty' => false)),
      'address'     => new sfWidgetFormTextarea(),
      'city'        => new sfWidgetFormTextarea(),
      'zipcode'     => new sfWidgetFormTextarea(),
      'phone'       => new sfWidgetFormTextarea(),
      'email'       => new sfWidgetFormTextarea(),
      'contactname' => new sfWidgetFormTextarea(),
      'radlocation' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'        => new sfValidatorString(),
      'id_isporg'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'))),
      'address'     => new sfValidatorString(array('required' => false)),
      'city'        => new sfValidatorString(array('required' => false)),
      'zipcode'     => new sfValidatorString(array('required' => false)),
      'phone'       => new sfValidatorString(array('required' => false)),
      'email'       => new sfValidatorString(array('required' => false)),
      'contactname' => new sfValidatorString(array('required' => false)),
      'radlocation' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acc_ispsuborg[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccIspsuborg';
  }

}
