<?php

/**
 * AccUsagedefinition form base class.
 *
 * @method AccUsagedefinition getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccUsagedefinitionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'id_isporg'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'add_empty' => false)),
      'definitionname'   => new sfWidgetFormTextarea(),
      'acctype'          => new sfWidgetFormTextarea(),
      'measureunit'      => new sfWidgetFormTextarea(),
      'billingunit'      => new sfWidgetFormInputText(),
      'pricebillingunit' => new sfWidgetFormInputText(),
      'priceonstart'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'id_isporg'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'required' => false)),
      'definitionname'   => new sfValidatorString(),
      'acctype'          => new sfValidatorString(),
      'measureunit'      => new sfValidatorString(array('required' => false)),
      'billingunit'      => new sfValidatorNumber(array('required' => false)),
      'pricebillingunit' => new sfValidatorNumber(array('required' => false)),
      'priceonstart'     => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acc_usagedefinition[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccUsagedefinition';
  }

}
