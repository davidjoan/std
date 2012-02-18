<?php

/**
 * Document form.
 *
 * @package    std
 * @subpackage form
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentViewForm extends BaseDocumentForm
{
  public function initialize()
  {
    $this->labels = array
                    (
                      //'record_id'         => 'Registro',
                      'representative_id' => 'Remitente',
                      'path'              => 'Documento Digital',
                      'document_class_id' => 'Tipo de registro',
                      'code'              => 'Código',
                      'qty'               => 'Folios',
                      'type'              => 'Tipo de tramite',
                      'description'       => 'Documento',
                      'observations'      => 'Observación',
                      'main'              => 'Asunto',
                      'reception_method'  => 'Metodo de Recepción',
                      'document_date'     => 'Fecha de Documento',
                      'reception_date'    => 'Fecha de Recepcion',
                      'registration_type' => 'Tipo de Tramite',
                      'active'            => 'Activo'
                    ); 
  }    
  
  public function configure()
  {
     $this->setWidgets(array
    (
      'id'                => new sfWidgetFormInputHidden(),
      'code'              => new sfWidgetFormValue(array('value' => $this->object->getCode())),
      'document_class_id' => new sfWidgetFormValue(array('value' => $this->object->getDocumentClass()->getName())),   
      'document_date'     => new sfWidgetFormValue(array('value' => $this->object->getDocumentDate())),   
      'description'       => new sfWidgetFormValue(array('value' => $this->object->getDescription())),   
      'representative_id' => new sfWidgetFormValue(array('value' => $this->object->getRepresentative())),
      'main'              => new sfWidgetFormValue(array('value' => $this->object->getMain())),
      'qty'               => new sfWidgetFormValue(array('value' => $this->object->getQty())),
      'registration_type' => new sfWidgetFormValue(array('value' => $this->object->getRegistrationTypeName())),
      'observations'      => new sfWidgetFormValue(array('value' => $this->object->getObservations())),
      'path'              => new sfWidgetFormInputFileEditable
                                (
                                  array
                                  (
                                    'file_src'     => $this->object->getPath(),
                                    'with_delete'  => false,
                                    'template'     => sprintf
                                                      (
                                                        '<a class="file_link" href="%s/%%file%%">%%file%%</a><br />%%input%%<br />%%delete%% %%delete_label%%', 
                                                        sfConfig::get('app_document_path_path')
                                                      )
                                  ),
                                  array('size'         => '60',)
                                ),
        
      'active'            => new sfWidgetFormSelect(array('choices' => $this->getTable()->getStatuss())),
            ));
        
      
    $this->addValidators(array
    (
      'path'                 => new sfValidatorFile(array
                                (
                                  'required'   => false,
                                  'path'       => sfConfig::get('app_document_path_dir').'/'
                                )),
    ));
      
      
      $this->types = array
      (
      'id'                => '=',
      'record_id'         => '-',
      'area_id'           => '-',
      'user_id'           => '-',
      'representative_id' => 'combo',
      'document_class_id' => 'combo',
      'code'              => '-',
      'issue'             => '-',
      'qty'               => 'fixed_number',
      'type'              => '-',
      'description'       => '=',
      'observations'      => 'text',
      'main'              => '=',
      'reception_method'  => '-',
      'document_date'     => 'date',
      'path'              => 'file',
      'reception_date'    => '-',
      'registration_type' => array('combo', array('choices' => array_keys($this->getObject()->getTable()->getRegistrationType()))),
      'active'            => array('combo', array('choices' => array_keys($this->getObject()->getTable()->getStatuss()))),
      'slug'              => '-',
      'created_at'        => '-',
      'updated_at'        => '-',
      );

      
  }
}
