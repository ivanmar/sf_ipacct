<?php

/**
 * AccPostpaccountlog form base class.
 *
 * @method AccPostpaccountlog getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAccPostpaccountlogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'id_postpaccount'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccPostpaccount'), 'add_empty' => false)),
      'srvstarttime'       => new sfWidgetFormDateTime(),
      'srvstoptime'        => new sfWidgetFormDateTime(),
      'timespent'          => new sfWidgetFormInputText(),
      'trafficspent'       => new sfWidgetFormInputText(),
      'id_systemuser'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccSystemuser'), 'add_empty' => false)),
      's_bill'             => new sfWidgetFormTextarea(),
      'accountinfo'        => new sfWidgetFormTextarea(),
      'id_usagedefinition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccUsagedefinition'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'id_postpaccount'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccPostpaccount'))),
      'srvstarttime'       => new sfValidatorDateTime(),
      'srvstoptime'        => new sfValidatorDateTime(array('required' => false)),
      'timespent'          => new sfValidatorInteger(array('required' => false)),
      'trafficspent'       => new sfValidatorInteger(array('required' => false)),
      'id_systemuser'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccSystemuser'))),
      's_bill'             => new sfValidatorString(array('required' => false)),
      'accountinfo'        => new sfValidatorString(array('required' => false)),
      'id_usagedefinition' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccUsagedefinition'))),
    ));

    $this->widgetSchema->setNameFormat('acc_postpaccountlog[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccPostpaccountlog';
  }

}
