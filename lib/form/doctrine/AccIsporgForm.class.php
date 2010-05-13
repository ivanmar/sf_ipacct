<?php

/**
 * AccIsporg form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */

class AccIsporgForm extends BaseAccIsporgForm
{
  public function configure()
  {

    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'radlocation'    => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInputText(),
      'address'        => new sfWidgetFormInputText(),
      'city'           => new sfWidgetFormInputText(),
      'zipcode'        => new sfWidgetFormInputText(),
      'phone'          => new sfWidgetFormInputText(),
      'contactname'    => new sfWidgetFormInputText(),
      'email_report'   => new sfWidgetFormInputText(),
      'email_nasadmin' => new sfWidgetFormInputText(),
      'pst_commission' => new sfWidgetFormInputText(),
      'billinginfo'    => new sfWidgetFormTextarea(),
    ));
 
    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'radlocation'    => new sfValidatorString(array('required' => false)),
      'name'           => new sfValidatorString(),
      'address'        => new sfValidatorString(array('required' => false)),
      'city'           => new sfValidatorString(array('required' => false)),
      'zipcode'        => new sfValidatorString(array('required' => false)),
      'phone'          => new sfValidatorString(array('required' => false)),
      'contactname'    => new sfValidatorString(array('required' => false)),
      'email_report'   => new sfValidatorEmail(array('required' => false)),
      'email_nasadmin' => new sfValidatorEmail(array('required' => false)),
      'pst_commission' => new sfValidatorNumber(array('required' => false)),
      'billinginfo'    => new sfValidatorString(array('required' => false)),
    ));
  }
}
