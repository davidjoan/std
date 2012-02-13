<?php

/**
 * Document form.
 *
 * @package    std
 * @subpackage form
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentForm extends BaseDocumentForm
{
  public function initialize()
  {
    $this->labels = array
                    (
                      //'record_id'         => 'Registro',
                      'representative_id' => 'Remitente',
                      'document_class_id' => 'Tipo de registro',
                      'code'              => 'Código',
                      'qty'               => 'Folios',
                      'type'              => 'Tipo de tramite',
                      'description'       => 'Documento',
                      'observations'      => 'Observación',
                      'main'              => 'Asunto',
                      'reception_method'  => 'Metodo de Recepción',
                      'document_date'     => 'Fecha de Ingreso',
                      'reception_date'    => 'Fecha de Recepcion',
                      'registration_type' => 'Tipo de Tramite',
                      'active'            => 'Activo'
                    ); 
  }    
  
  public function configure()
  {
   $this->object->loadNextCode();
    $this->setWidgets(array
    (
      'id'                => new sfWidgetFormInputHidden(),
      'code'              => new sfWidgetFormValue(array('value' => $this->object->getCode())),
      'document_class_id' => new sfWidgetFormDoctrineChoice
                              (
                                array
                                (
                                  'model' => 'DocumentClass', 
                                  'add_empty' => '--- Seleccionar ---',
                                  'order_by' => array('Name', 'ASC')
                                )
                              ),   
      'document_date'     => new sfWidgetFormDateJQueryUI(array('change_month' => true, 'change_year' => true, 'show_button_panel' => true), array('readonly' => 'readonly')),            
      'description'       => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
      'representative_id' => new sfWidgetFormDoctrineChoice
                              (
                                array
                                (
                                  'model' => 'Representative', 
                                  'add_empty' => '--- Seleccionar ---',
                                  'order_by' => array('Lastname', 'ASC')
                                )
                              ),
      
      'main'              => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
      'qty'               => new sfWidgetFormInput(array(), array('size' => '20')),
      'registration_type' => new sfWidgetFormSelect(array('choices' => $this->getTable()->getRegistrationType())),
      'observations'      => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
      'active'            => new sfWidgetFormSelect(array('choices' => $this->getTable()->getStatuss())),
            ));
        
      $this->setDefaults(array(
          'document_date' =>date('j/m/Y')
      ));
      
      $this->types = array
      (
      'id'                => '=',
      'record_id'         => '-',
      'representative_id' => 'combo',
      'document_class_id' => 'combo',
      'code'              => '-',
      'issue'             => '-',
      'qty'               => 'fixed_number',
      'type'              => '-',
      'description'       => '=',
      'observations'      => '=',
      'main'              => '=',
      'reception_method'  => '-',
      'document_date'     => 'date',
      'reception_date'    => '-',
      'registration_type' => array('combo', array('choices' => array_keys($this->getObject()->getTable()->getRegistrationType()))),
      'active'            => array('combo', array('choices' => array_keys($this->getObject()->getTable()->getStatuss()))),
      'slug'              => '-',
      'created_at'        => '-',
      'updated_at'        => '-',
      );

      
  }
}
