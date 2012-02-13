<?php

/**
 * User form base class.
 *
 * @method User getObject() Returns the current form's model object
 *
 * @package    std
 * @subpackage form
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'area_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Area'), 'add_empty' => false)),
      'profile_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profile'), 'add_empty' => false)),
      'username'       => new sfWidgetFormInputText(),
      'password'       => new sfWidgetFormInputText(),
      'first_name'     => new sfWidgetFormInputText(),
      'last_name'      => new sfWidgetFormInputText(),
      'email'          => new sfWidgetFormInputText(),
      'phone'          => new sfWidgetFormInputText(),
      'active'         => new sfWidgetFormInputText(),
      'last_access_at' => new sfWidgetFormDateTime(),
      'slug'           => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'area_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Area'))),
      'profile_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profile'))),
      'username'       => new sfValidatorString(array('max_length' => 100)),
      'password'       => new sfValidatorString(array('max_length' => 255)),
      'first_name'     => new sfValidatorString(array('max_length' => 100)),
      'last_name'      => new sfValidatorString(array('max_length' => 100)),
      'email'          => new sfValidatorString(array('max_length' => 100)),
      'phone'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'active'         => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'last_access_at' => new sfValidatorDateTime(array('required' => false)),
      'slug'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'User', 'column' => array('username'))),
        new sfValidatorDoctrineUnique(array('model' => 'User', 'column' => array('first_name', 'last_name'))),
        new sfValidatorDoctrineUnique(array('model' => 'User', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }

}
