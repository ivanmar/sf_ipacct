<?php

/**
 * AccSystemuser form base class.
 *
 * @method AccSystemuser getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccSystemuserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'username'     => new sfWidgetFormTextarea(),
      'pass'         => new sfWidgetFormTextarea(),
      'acctype'      => new sfWidgetFormTextarea(),
      'id_isporg'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'add_empty' => false)),
      'id_ispsuborg' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'), 'add_empty' => true)),
      'name'         => new sfWidgetFormTextarea(),
      'email'        => new sfWidgetFormTextarea(),
      'phone'        => new sfWidgetFormTextarea(),
      'mobile'       => new sfWidgetFormTextarea(),
      'lang'         => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'username'     => new sfValidatorString(),
      'pass'         => new sfValidatorString(),
      'acctype'      => new sfValidatorString(),
      'id_isporg'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'))),
      'id_ispsuborg' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'), 'required' => false)),
      'name'         => new sfValidatorString(array('required' => false)),
      'email'        => new sfValidatorString(array('required' => false)),
      'phone'        => new sfValidatorString(array('required' => false)),
      'mobile'       => new sfValidatorString(array('required' => false)),
      'lang'         => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acc_systemuser[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccSystemuser';
  }

}
