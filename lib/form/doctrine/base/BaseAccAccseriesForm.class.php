<?php

/**
 * AccAccseries form base class.
 *
 * @method AccAccseries getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccAccseriesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'id_usagedefinition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccUsagedefinition'), 'add_empty' => false)),
      'id_isporg'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'add_empty' => false)),
      'id_systemuser'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccSystemuser'), 'add_empty' => false)),
      'crdate'             => new sfWidgetFormDateTime(),
      'nraccount'          => new sfWidgetFormInputText(),
      'acctype'            => new sfWidgetFormTextarea(),
      'pst_commission'     => new sfWidgetFormInputText(),
      'id_ispsuborg'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'id_usagedefinition' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccUsagedefinition'))),
      'id_isporg'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'))),
      'id_systemuser'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccSystemuser'))),
      'crdate'             => new sfValidatorDateTime(),
      'nraccount'          => new sfValidatorNumber(),
      'acctype'            => new sfValidatorString(),
      'pst_commission'     => new sfValidatorNumber(array('required' => false)),
      'id_ispsuborg'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acc_accseries[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccAccseries';
  }

}
