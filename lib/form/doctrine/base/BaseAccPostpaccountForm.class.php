<?php

/**
 * AccPostpaccount form base class.
 *
 * @method AccPostpaccount getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccPostpaccountForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'username'     => new sfWidgetFormTextarea(),
      'id_isporg'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'add_empty' => false)),
      'id_ispsuborg' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'), 'add_empty' => false)),
      'id_accseries' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccAccseries'), 'add_empty' => false)),
      'ind_active'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'username'     => new sfValidatorString(),
      'id_isporg'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'))),
      'id_ispsuborg' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'))),
      'id_accseries' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccAccseries'))),
      'ind_active'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acc_postpaccount[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccPostpaccount';
  }

}
