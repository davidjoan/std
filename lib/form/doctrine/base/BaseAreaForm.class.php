<?php

/**
 * Area form base class.
 *
 * @method Area getObject() Returns the current form's model object
 *
 * @package    std
 * @subpackage form
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAreaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'representative_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Representative'), 'add_empty' => false)),
      'rank'              => new sfWidgetFormInputText(),
      'name'              => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormTextarea(),
      'active'            => new sfWidgetFormInputText(),
      'slug'              => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'root_id'           => new sfWidgetFormInputText(),
      'lft'               => new sfWidgetFormInputText(),
      'rgt'               => new sfWidgetFormInputText(),
      'level'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'representative_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Representative'))),
      'rank'              => new sfValidatorInteger(array('required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 50)),
      'description'       => new sfValidatorString(array('max_length' => 5000, 'required' => false)),
      'active'            => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'slug'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'root_id'           => new sfValidatorInteger(array('required' => false)),
      'lft'               => new sfValidatorInteger(array('required' => false)),
      'rgt'               => new sfValidatorInteger(array('required' => false)),
      'level'             => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Area', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('area[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Area';
  }

}
