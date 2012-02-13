<?php

/**
 * Area form.
 *
 * @package    std
 * @subpackage form
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AreaForm extends BaseAreaForm
{
  public function initialize()
  {
    $this->labels = array
    (
      'parent'            => 'Area Superior',    
      'representative_id' => 'Representante',
      'name'              => 'Nombre',    
      'active'            => 'Activo',
      'rank'              => ''
    );
  }
  public function configure()
  {
    $this->setWidgets(array
    (
      'id'                   => new sfWidgetFormInputHidden(),
      'rank'                 => new sfWidgetFormInputHidden(),        
      'parent'               => ($this->getObject()->getId() == 1)?
                                new sfWidgetFormValue(array('value' => 'Nodo Principal'))
                                :new sfWidgetFormDoctrineChoiceNestedSet(array(
                                'model'     => 'Area',
                                'add_empty' => false ,
                                'method'    => 'getName'
                             )),
      'representative_id' => new sfWidgetFormDoctrineChoice
                              (
                                array
                                (
                                  'model' => 'Representative', 
                                  'add_empty' => '--- Seleccionar ---',
                                  'order_by' => array('Firstname', 'ASC')
                                )
                              ),        
      'name'                 => new sfWidgetFormInput(array(), array('size' => '40')),
      'description'          => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
      'active'               => new sfWidgetFormChoice(array
                                (
                                  'choices'          => $this->getTable()->getStatuss(),
                                  'expanded'         => true,
                                  'renderer_options' => array('formatter' => array($this->widgetFormatter, 'radioFormatter'))
                                ))
    ));
    
    
    if ($this->getObject()->getNode()->hasParent())
    {
      $this->setDefaults
      (
        array
        (
          'parent' => $this->getObject()->getNode()->getParent()->getId(),
          'rank '  => $this->getObject()->getRank(),
        )
      );
    }
   
   $this->addValidators(array
    (
      'parent'               => new sfValidatorDoctrineChoiceNestedSet(array
                                (
                                  'model' => 'Area',
                                  'node'  => $this->getObject()
                                 )) 
    ));
   
    if ($this->getObject()->getId() == 1)
    {
      $this->validatorSchema['parent']->setOption('required', false); 
      //new sfWidgetFormValue(array('value' => $this->object->getCode())),
    }
  	
    $this->types = array
    (
      'root_id'     => '-',
      'rank'        => 'pass',
      'representative_id' => 'combo',
      'parent'      => ($this->getObject()->getId() == 1)?'-':'=',
      'lft'         => '-',
      'rgt'         => '-',
      'level'       => '-',
      'id'          => '=',
      'name'        => 'name',
      'description' => '=',
      'active'      => array('combo', array('choices' => array_keys($this->getTable()->getStatuss()))),
      'created_at'  => '-',
      'updated_at'  => '-',
      'created_by'  => '-',
      'updated_by'  => '-'
    );
  }
  
    public function doSave($con = null)
  {
  	
    // save the record itself
    parent::doSave($con);
    // if a parent has been specified, add/move this node to be the child of that node
    if ($this->getValue('parent'))
    {
      $parent = Doctrine::getTable('Area')->findOneById($this->getValue('parent'));
      if ($this->isNew())
      {
        $this->getObject()->getNode()->insertAsLastChildOf($parent);
      }
      else
      {
        $this->getObject()->getNode()->moveAsLastChildOf($parent);
      }
    }
    // if no parent was selected, add/move this node to be a new root in the tree
    else
    {
      $categoryTree = Doctrine::getTable('Area')->getTree();
      if ($this->isNew())
      {
        $categoryTree->createRoot($this->getObject());
      }
      else
      {
        $this->getObject()->getNode()->makeRoot($this->getObject()->getId());
      }
    }
  }


}
