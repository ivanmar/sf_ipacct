<?php

/**
 * AccUsagedefinition filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccUsagedefinitionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_isporg'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'add_empty' => true)),
      'definitionname'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'acctype'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'measureunit'      => new sfWidgetFormFilterInput(),
      'billingunit'      => new sfWidgetFormFilterInput(),
      'pricebillingunit' => new sfWidgetFormFilterInput(),
      'priceonstart'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_isporg'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccIsporg'), 'column' => 'id')),
      'definitionname'   => new sfValidatorPass(array('required' => false)),
      'acctype'          => new sfValidatorPass(array('required' => false)),
      'measureunit'      => new sfValidatorPass(array('required' => false)),
      'billingunit'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'pricebillingunit' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'priceonstart'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('acc_usagedefinition_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccUsagedefinition';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'id_isporg'        => 'ForeignKey',
      'definitionname'   => 'Text',
      'acctype'          => 'Text',
      'measureunit'      => 'Text',
      'billingunit'      => 'Number',
      'pricebillingunit' => 'Number',
      'priceonstart'     => 'Number',
    );
  }
}
