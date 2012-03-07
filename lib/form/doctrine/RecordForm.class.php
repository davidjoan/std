<?php

/**
 * Record form.
 *
 * @package    std
 * @subpackage form
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RecordForm extends BaseRecordForm
{
  protected
    $documentDynamicFormManager = null;
    
  public function initialize()
  {
    $this->labels = array
                    (
                      'from_area_id' => 'Area Origen',
                      'to_area_id'   => 'Area Destino',
                      'user_id'      => 'Usuario Creador',
                      'code'         => 'Codigo',
                      'subject'      => 'Asunto',
                      'time_limit'   => 'Tiempo limite',
                      'description'  => 'Observaciones',
                      'status_show'  => 'Estado',
                      'status'       => 'Estado',
                      'to_area_id_show' => 'Area Destino'
                    ); 
  }    
  
  public function configure()
  {
     $this->object->setUser(Doctrine::getTable('User')->findOneById(sfContext::getInstance()->getUser()->getUserId()));      
       $area_id = sfContext::getInstance()->getUser()->getAreaId();       
     $status = sfContext::getInstance()->getRequest()->getParameter('status');
    if($this->object->getStatus() == RecordTable::STATUS_PENDING)
    {
      $area_id = sfContext::getInstance()->getUser()->getAreaId();
      $this->object->loadNextCode();
      $this->object->setFromArea(Doctrine::getTable('Area')->findOneById($area_id));
            
    $this->setWidgets(array
    (
      'id'                => new sfWidgetFormInputHidden(),
      'code'              => new sfWidgetFormValue(array('value' => $this->object->getCode())),
      'user_id'           => new sfWidgetFormValue(array('value' => $this->object->getUser()->getName())),
      'from_area_id'      => new sfWidgetFormValue(array('value' => $this->object->getFromArea()->getName())),
      'subject'           => new sfWidgetFormInput(array(), array('size' => '80')),
      'time_limit'        => new sfWidgetFormInput(array(), array('size' => '3','maxlength' => 3)),
      'status_show'       => new sfWidgetFormValue(array('value' => $this->object->getStatusStr())),
      'status'            => new sfWidgetFormInputHidden(),
      'description'       => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
            ));
        

      $this->types = array
      (
        'id'           => '=',
        'from_area_id' => '-',
        'to_area_id'   => '-',
        'user_id'      => '-',
        'code'         => '-',
        'subject'      => 'text',
        'time_limit'   => 'fixed_number',
        'description'  => 'text',
        'status'       => 'code',
        'status_show'  => '-',  
        'active'       => '-',
        'slug'         => '-',
        'created_at'   => '-',
        'updated_at'   => '-',
      );        
        
    }
    elseif($this->object->getStatus() == RecordTable::STATUS_RECEIVED or $this->object->getStatus() == RecordTable::STATUS_COMPLETED ){
    $this->setWidgets(array
    (
      'id'                => new sfWidgetFormInputHidden(),
      'code'              => new sfWidgetFormValue(array('value' => $this->object->getCode())),
      'user_id'           => new sfWidgetFormValue(array('value' => $this->object->getUser()->getName())),
      'from_area_id'      => new sfWidgetFormValue(array('value' => $this->object->getFromArea()->getName())),
      'to_area_id'        => new sfWidgetFormValue(array('value' => $this->object->getToArea()->getName())), 
      'subject'           => new sfWidgetFormInput(array(), array('size' => '50')),
      'time_limit'        => new sfWidgetFormInput(array(), array('size' => '3','maxlength' => 3)),
      'status_show'       => new sfWidgetFormValue(array('value' => $this->object->getStatusStr())),
      'status'            => new sfWidgetFormInputHidden(),
      'description'       => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
            ));
        

      $this->types = array
      (
        'id'           => '=',
        'from_area_id' => '-',
        'to_area_id'   => '-',
        'user_id'      => '-',
        'code'         => '-',
        'subject'      => 'text',
        'time_limit'   => 'fixed_number',
        'description'  => 'text',
        'status'       => 'code',
        'status_show'  => '-',  
        'active'       => '-',
        'slug'         => '-',
        'created_at'   => '-',
        'updated_at'   => '-',
      );        
    }
    elseif($this->object->getStatus() == RecordTable::STATUS_RETURNED){
    //
    $this->object->setToArea(Doctrine::getTable('Area')->findOneById($this->object->getFromAreaId()));
    $this->object->setFromArea(Doctrine::getTable('Area')->findOneById($area_id));
      
    
    $this->setWidgets(array
    (
      'id'                => new sfWidgetFormInputHidden(),
      'code'              => new sfWidgetFormValue(array('value' => $this->object->getCode())),
      'user_id'           => new sfWidgetFormValue(array('value' => $this->object->getUser()->getName())),
      'from_area_id'      => new sfWidgetFormValue(array('value' => $this->object->getFromArea()->getName())),
      'to_area_id'        => new sfWidgetFormValue(array('value' => $this->object->getToArea()->getName())), 
      'subject'           => new sfWidgetFormInput(array(), array('size' => '50')),
      'time_limit'        => new sfWidgetFormInput(array(), array('size' => '3','maxlength' => 3)),
      'status_show'       => new sfWidgetFormValue(array('value' => $this->object->getStatusStr())),
      'status'            => new sfWidgetFormInputHidden(),
      'description'       => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
            ));
        

      $this->types = array
      (
        'id'           => '=',
        'from_area_id' => '-',
        'to_area_id'   => '-',
        'user_id'      => '-',
        'code'         => '-',
        'subject'      => 'text',
        'time_limit'   => 'fixed_number',
        'description'  => 'text',
        'status'       => 'code',
        'status_show'  => '-',  
        'active'       => '-',
        'slug'         => '-',
        'created_at'   => '-',
        'updated_at'   => '-',
      );        
    }    
    elseif($this->object->getStatus() == RecordTable::STATUS_DERIVED and $status == null){
             $this->object->setFromArea(Doctrine::getTable('Area')->findOneById($area_id));
   
    $this->setWidgets(array
    (
      'id'                => new sfWidgetFormInputHidden(),
      'code'              => new sfWidgetFormValue(array('value' => $this->object->getCode())),
      'user_id'           => new sfWidgetFormValue(array('value' => $this->object->getUser()->getName())),
      'from_area_id'      => new sfWidgetFormValue(array('value' => $this->object->getFromArea()->getName())),
      'to_area_id'        => new sfWidgetFormValue(array('value' => $this->object->getToArea()->getName())), 
      'subject'           => new sfWidgetFormInput(array(), array('size' => '50')),
      'time_limit'        => new sfWidgetFormInput(array(), array('size' => '3','maxlength' => 3)),
      'status_show'       => new sfWidgetFormValue(array('value' => $this->object->getStatusStr())),
      'status'            => new sfWidgetFormInputHidden(),
      'description'       => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
            ));
        

      $this->types = array
      (
        'id'           => '=',
        'from_area_id' => '-',
        'to_area_id'   => '-',
        'user_id'      => '-',
        'code'         => '-',
        'subject'      => 'text',
        'time_limit'   => 'fixed_number',
        'description'  => 'text',
        'status'       => 'code',
        'status_show'  => '-',  
        'active'       => '-',
        'slug'         => '-',
        'created_at'   => '-',
        'updated_at'   => '-',
      );       
      $this->validatorSchema['to_area_id']->setOption('required', true);
    }   
      elseif($this->object->getStatus() == RecordTable::STATUS_DERIVED){
             $this->object->setFromArea(Doctrine::getTable('Area')->findOneById($area_id));
   
    $this->setWidgets(array
    (
      'id'                => new sfWidgetFormInputHidden(),
      'code'              => new sfWidgetFormValue(array('value' => $this->object->getCode())),
      'user_id'           => new sfWidgetFormValue(array('value' => $this->object->getUser()->getName())),
      'from_area_id'      => new sfWidgetFormValue(array('value' => $this->object->getFromArea()->getName())),
      'to_area_id'        => new sfWidgetFormDoctrineChoice
                              (
                                array
                                (
                                  'model' => 'Area',
                               //   'add_empty' => '--- Seleccionar ---',
                                  'query' => Doctrine::getTable('Record')->getOtherAreas($area_id),
                                  'order_by' => array('Name', 'ASC')
                                )
                              ), 
      'subject'           => new sfWidgetFormInput(array(), array('size' => '50')),
      'time_limit'        => new sfWidgetFormInput(array(), array('size' => '3','maxlength' => 3)),
      'status_show'       => new sfWidgetFormValue(array('value' => $this->object->getStatusStr())),
      'status'            => new sfWidgetFormInputHidden(),
      'description'       => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
            ));
        

      $this->types = array
      (
        'id'           => '=',
        'from_area_id' => '-',
        'to_area_id'   => 'combo',
        'user_id'      => '-',
        'code'         => '-',
        'subject'      => 'text',
        'time_limit'   => 'fixed_number',
        'description'  => 'text',
        'status'       => 'code',
        'status_show'  => '-',  
        'active'       => '-',
        'slug'         => '-',
        'created_at'   => '-',
        'updated_at'   => '-',
      );       
      $this->validatorSchema['to_area_id']->setOption('required', true);
    }     
    else {
    $this->setWidgets(array
    (
      'id'                => new sfWidgetFormInputHidden(),
      'code'              => new sfWidgetFormValue(array('value' => $this->object->getCode())),
      'user_id'           => new sfWidgetFormValue(array('value' => $this->object->getUser()->getName())),
      'from_area_id'      => new sfWidgetFormValue(array('value' => $this->object->getFromArea()->getName())),
      'to_area_id'        => new sfWidgetFormInputHidden(),
      'subject'           => new sfWidgetFormInput(array(), array('size' => '50')),
      'time_limit'        => new sfWidgetFormInput(array(), array('size' => '3','maxlength' => 3)),
      'status_show'       => new sfWidgetFormValue(array('value' => $this->object->getStatusStr())),
      'status'            => new sfWidgetFormInputHidden(),
      'description'       => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
            ));
        

      $this->types = array
      (
        'id'           => '=',
        'from_area_id' => '-',
        'to_area_id'   => '-',
        'user_id'      => '-',
        'code'         => '-',
        'subject'      => 'text',
        'time_limit'   => 'fixed_number',
        'description'  => 'text',
        'status'       => 'code',
        'status_show'  => '-',  
        'active'       => '-',
        'slug'         => '-',
        'created_at'   => '-',
        'updated_at'   => '-',
      );        
    }
    

      
    //  $this->validatorSchema['time_limit']->setOption('required', true); 
      $this->addDocumentsForm();
  }
  
  public function addDocumentsForm()
  {
    $this->documentDynamicFormManager = new sfDynamicFormEmbedderManager('document', $this->object->getDocuments()->getRelation(), 'Documentos', $this, null, new sfCallable(array($this->object, 'getDocuments')));
  }
  
}
