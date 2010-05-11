<?php

/**
 * AccIsporg form base class.
 *
 * @method AccIsporg getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccIsporgForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormTextarea(),
      'address'        => new sfWidgetFormTextarea(),
      'city'           => new sfWidgetFormTextarea(),
      'zipcode'        => new sfWidgetFormTextarea(),
      'phone'          => new sfWidgetFormTextarea(),
      'billinginfo'    => new sfWidgetFormTextarea(),
      'contactname'    => new sfWidgetFormTextarea(),
      'email_report'   => new sfWidgetFormTextarea(),
      'email_nasadmin' => new sfWidgetFormTextarea(),
      'pst_commission' => new sfWidgetFormInputText(),
      'radlocation'    => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'           => new sfValidatorString(),
      'address'        => new sfValidatorString(array('required' => false)),
      'city'           => new sfValidatorString(array('required' => false)),
      'zipcode'        => new sfValidatorString(array('required' => false)),
      'phone'          => new sfValidatorString(array('required' => false)),
      'billinginfo'    => new sfValidatorString(array('required' => false)),
      'contactname'    => new sfValidatorString(array('required' => false)),
      'email_report'   => new sfValidatorString(array('required' => false)),
      'email_nasadmin' => new sfValidatorString(array('required' => false)),
      'pst_commission' => new sfValidatorNumber(array('required' => false)),
      'radlocation'    => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acc_isporg[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccIsporg';
  }

}
