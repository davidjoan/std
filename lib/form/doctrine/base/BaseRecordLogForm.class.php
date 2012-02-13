<?php

/**
 * RecordLog form base class.
 *
 * @method RecordLog getObject() Returns the current form's model object
 *
 * @package    std
 * @subpackage form
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRecordLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'record_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Record'), 'add_empty' => false)),
      'user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'from_area_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FromArea'), 'add_empty' => false)),
      'to_area_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ToArea'), 'add_empty' => false)),
      'code'         => new sfWidgetFormInputText(),
      'subject'      => new sfWidgetFormInputText(),
      'time_limit'   => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),
      'status'       => new sfWidgetFormInputText(),
      'active'       => new sfWidgetFormInputText(),
      'slug'         => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'record_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Record'))),
      'user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'from_area_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('FromArea'))),
      'to_area_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ToArea'))),
      'code'         => new sfValidatorString(array('max_length' => 20)),
      'subject'      => new sfValidatorString(array('max_length' => 250)),
      'time_limit'   => new sfValidatorInteger(array('required' => false)),
      'description'  => new sfValidatorString(array('max_length' => 1000)),
      'status'       => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'active'       => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'slug'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'RecordLog', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('record_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RecordLog';
  }

}
