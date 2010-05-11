<?php

/**
 * AccPrepaccount form base class.
 *
 * @method AccPrepaccount getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccPrepaccountForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'username'      => new sfWidgetFormTextarea(),
      'id_accseries'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccAccseries'), 'add_empty' => false)),
      'id_isporg'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'), 'add_empty' => false)),
      'id_ispsuborg'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'), 'add_empty' => true)),
      'id_systemuser' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccSystemuser'), 'add_empty' => true)),
      's_card'        => new sfWidgetFormTextarea(),
      'dateissue'     => new sfWidgetFormDateTime(),
      'datesale'      => new sfWidgetFormDateTime(),
      'datestorn'     => new sfWidgetFormDateTime(),
      'ind_ondemand'  => new sfWidgetFormTextarea(),
      'datefirstuse'  => new sfWidgetFormDateTime(),
      'datelastuse'   => new sfWidgetFormDateTime(),
      'trafficspent'  => new sfWidgetFormInputText(),
      'nrsession'     => new sfWidgetFormInputText(),
      'ind_used'      => new sfWidgetFormTextarea(),
      'timespent'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'username'      => new sfValidatorString(),
      'id_accseries'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccAccseries'))),
      'id_isporg'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccIsporg'))),
      'id_ispsuborg'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccIspsuborg'), 'required' => false)),
      'id_systemuser' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccSystemuser'), 'required' => false)),
      's_card'        => new sfValidatorString(),
      'dateissue'     => new sfValidatorDateTime(array('required' => false)),
      'datesale'      => new sfValidatorDateTime(array('required' => false)),
      'datestorn'     => new sfValidatorDateTime(array('required' => false)),
      'ind_ondemand'  => new sfValidatorString(array('required' => false)),
      'datefirstuse'  => new sfValidatorDateTime(array('required' => false)),
      'datelastuse'   => new sfValidatorDateTime(array('required' => false)),
      'trafficspent'  => new sfValidatorInteger(array('required' => false)),
      'nrsession'     => new sfValidatorNumber(array('required' => false)),
      'ind_used'      => new sfValidatorString(array('required' => false)),
      'timespent'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acc_prepaccount[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccPrepaccount';
  }

}
