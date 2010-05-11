<?php

/**
 * AccIsporg filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccIsporgFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'address'        => new sfWidgetFormFilterInput(),
      'city'           => new sfWidgetFormFilterInput(),
      'zipcode'        => new sfWidgetFormFilterInput(),
      'phone'          => new sfWidgetFormFilterInput(),
      'billinginfo'    => new sfWidgetFormFilterInput(),
      'contactname'    => new sfWidgetFormFilterInput(),
      'email_report'   => new sfWidgetFormFilterInput(),
      'email_nasadmin' => new sfWidgetFormFilterInput(),
      'pst_commission' => new sfWidgetFormFilterInput(),
      'radlocation'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'           => new sfValidatorPass(array('required' => false)),
      'address'        => new sfValidatorPass(array('required' => false)),
      'city'           => new sfValidatorPass(array('required' => false)),
      'zipcode'        => new sfValidatorPass(array('required' => false)),
      'phone'          => new sfValidatorPass(array('required' => false)),
      'billinginfo'    => new sfValidatorPass(array('required' => false)),
      'contactname'    => new sfValidatorPass(array('required' => false)),
      'email_report'   => new sfValidatorPass(array('required' => false)),
      'email_nasadmin' => new sfValidatorPass(array('required' => false)),
      'pst_commission' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'radlocation'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acc_isporg_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccIsporg';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'name'           => 'Text',
      'address'        => 'Text',
      'city'           => 'Text',
      'zipcode'        => 'Text',
      'phone'          => 'Text',
      'billinginfo'    => 'Text',
      'contactname'    => 'Text',
      'email_report'   => 'Text',
      'email_nasadmin' => 'Text',
      'pst_commission' => 'Number',
      'radlocation'    => 'Text',
    );
  }
}
