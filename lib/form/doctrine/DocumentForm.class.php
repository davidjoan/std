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
                    //  'representative_id' => 'Remitente',
                      'path'              => 'Documento Digital',
                      'document_class_id' => 'Tipo de documento',
                      'code'              => 'Código',
                      'qty'               => 'Folios',
                      'type'              => 'Tipo de tramite',
                      'description'       => 'Remitente',
                      'observations'      => 'Observación',
                      'main'              => 'Asunto',
                      'reception_method'  => 'Metodo de Recepción',
                      'document_date'     => 'Fecha de Documento',
                      'reception_date'    => 'Fecha de Recepcion',
                      'registration_type' => 'Tipo de Tramite',
                   //   'active'            => 'Activo'
                    ); 
  }    
  
  public function configure()
  {
    $area_id = sfContext::getInstance()->getUser()->getAreaId();      
    $this->object->loadNextCode();
    $this->object->setArea(Doctrine::getTable('Area')->findOneById($area_id));
    $this->object->setUser(Doctrine::getTable('User')->findOneById(sfContext::getInstance()->getUser()->getUserId()));   
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
     // 'document_date'     => new sfWidgetFormDateJQueryUI(array('change_month' => true, 'change_year' => true, 'show_button_panel' => true), array('readonly' => 'readonly')),            
       'document_date'        => new sfWidgetFormDateExt(array
                                (
                                  'format'     => $this->widgetFormatter->getStandardDateFormat(),
                                  'year_start' => date('Y') - 5,
                                  'year_end'   => date('Y'),
                                )),
      //'description'       => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
      'description'       => new sfWidgetFormInput(array(), array('size' => '50')),
 /*     'representative_id' => new sfWidgetFormDoctrineChoice
                              (
                                array
                                (
                                  'model' => 'Representative', 
                                  'add_empty' => '--- Seleccionar ---',
                                  'order_by' => array('Lastname', 'ASC')
                                )
                              ),
      */
      'main'              => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
      'qty'               => new sfWidgetFormInput(array(), array('size' => '3','maxlength' => 3)),
      'registration_type' => new sfWidgetFormSelect(array('choices' => $this->getTable()->getRegistrationType())),
      'observations'      => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
      'path'                 => new sfWidgetFormInputFileEditable
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
        
    //  'active'            => new sfWidgetFormSelect(array('choices' => $this->getTable()->getStatuss())),
            ));
        
      $this->setDefaults(array(
          'document_date' =>date('j/m/Y')
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
      'representative_id' => '-',
      'document_class_id' => 'combo',
      'code'              => '-',
      'issue'             => '-',
      'qty'               => 'fixed_number',
      'type'              => '-',
      'description'       => 'name',
      'observations'      => 'text',
      'main'              => 'text',
      'reception_method'  => '-',
      'document_date'     => 'date',
      'path'              => 'file',
      'reception_date'    => '-',
      'registration_type' => array('combo', array('choices' => array_keys($this->getObject()->getTable()->getRegistrationType()))),
    //  'active'            => array('combo', array('choices' => array_keys($this->getObject()->getTable()->getStatuss()))),
      'active'            => '-',
      'slug'              => '-',
      'created_at'        => '-',
      'updated_at'        => '-',
      );
      
      
      $this->validatorSchema['document_class_id']->setOption('required', true); 
      $this->validatorSchema['document_date']->setOption('required', true); 
      $this->validatorSchema['description']->setOption('required', true); 
      $this->validatorSchema['main']->setOption('required', true); 
      $this->validatorSchema['registration_type']->setOption('required', true); 

      
  }
}
