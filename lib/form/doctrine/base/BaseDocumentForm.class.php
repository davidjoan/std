<?php

/**
 * Document form base class.
 *
 * @method Document getObject() Returns the current form's model object
 *
 * @package    std
 * @subpackage form
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'record_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Record'), 'add_empty' => false)),
      'user_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'area_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Area'), 'add_empty' => false)),
      'representative_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Representative'), 'add_empty' => true)),
      'document_class_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentClass'), 'add_empty' => true)),
      'code'              => new sfWidgetFormInputText(),
      'issue'             => new sfWidgetFormInputText(),
      'qty'               => new sfWidgetFormInputText(),
      'type'              => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormTextarea(),
      'observations'      => new sfWidgetFormTextarea(),
      'main'              => new sfWidgetFormTextarea(),
      'reception_method'  => new sfWidgetFormInputText(),
      'document_date'     => new sfWidgetFormDateTime(),
      'reception_date'    => new sfWidgetFormDateTime(),
      'registration_type' => new sfWidgetFormInputText(),
      'path'              => new sfWidgetFormInputText(),
      'active'            => new sfWidgetFormInputText(),
      'slug'              => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'record_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Record'))),
      'user_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'area_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Area'))),
      'representative_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Representative'), 'required' => false)),
      'document_class_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentClass'), 'required' => false)),
      'code'              => new sfValidatorString(array('max_length' => 50)),
      'issue'             => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'qty'               => new sfValidatorInteger(array('required' => false)),
      'type'              => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'description'       => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'observations'      => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'main'              => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'reception_method'  => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'document_date'     => new sfValidatorDateTime(array('required' => false)),
      'reception_date'    => new sfValidatorDateTime(array('required' => false)),
      'registration_type' => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'path'              => new sfValidatorString(array('max_length' => 255)),
      'active'            => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'slug'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'Document', 'column' => array('code'))),
        new sfValidatorDoctrineUnique(array('model' => 'Document', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('document[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Document';
  }

}
