<?php

/**
 * Record actions.
 *
 * @package    std
 * @subpackage Record
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RecordActions extends ActionsCrud
{
  protected function complementObject(sfWebRequest $request)
  {
      //Deb::print_r($request->getParameterHolder()->getAll());
      $this->status = $request->getParameter('status');
      if($this->status <> '')
      {
        $this->object->setStatus($this->status);    
      }
      
  }
  
  protected function getExtraFilterAndArrangeFields()
  {
    return array
    (
      'fa'  => array('from_area_name' => 'name'),
      'ta'  => array('to_area_name' => 'name'),
      'u'   => array('user_name' => 'last_name'),
    );
  }
  
  protected function complementList(sfWebRequest $request, DoctrineQuery $q)
  {
    sfDynamicFormEmbedder::resetParams('document');
    
    Doctrine::getTable($this->modelClass)->updateQueryForList($q);
  }
  

    
}
