<?php

/**
 * Representative form base class.
 *
 * @method Representative getObject() Returns the current form's model object
 *
 * @package    std
 * @subpackage form
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRepresentativeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'dni'         => new sfWidgetFormInputText(),
      'firstname'   => new sfWidgetFormInputText(),
      'lastname'    => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'active'      => new sfWidgetFormInputText(),
      'slug'        => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'dni'         => new sfValidatorString(array('max_length' => 20)),
      'firstname'   => new sfValidatorString(array('max_length' => 200)),
      'lastname'    => new sfValidatorString(array('max_length' => 200)),
      'description' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'active'      => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'slug'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Representative', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('representative[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Representative';
  }

}
