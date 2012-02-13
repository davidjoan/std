<?php

/**
 * Action form base class.
 *
 * @method Action getObject() Returns the current form's model object
 *
 * @package    std
 * @subpackage form
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseActionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormInputText(),
      'route'         => new sfWidgetFormInputText(),
      'param'         => new sfWidgetFormInputText(),
      'slug'          => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'profiles_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Profile')),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 100)),
      'description'   => new sfValidatorString(array('max_length' => 255)),
      'route'         => new sfValidatorString(array('max_length' => 200)),
      'param'         => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'slug'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'profiles_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Profile', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'Action', 'column' => array('param'))),
        new sfValidatorDoctrineUnique(array('model' => 'Action', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('action[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Action';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['profiles_list']))
    {
      $this->setDefault('profiles_list', $this->object->Profiles->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveProfilesList($con);

    parent::doSave($con);
  }

  public function saveProfilesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['profiles_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Profiles->getPrimaryKeys();
    $values = $this->getValue('profiles_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Profiles', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Profiles', array_values($link));
    }
  }

}
