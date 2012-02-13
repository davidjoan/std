<?php

/**
 * ActionsCrud
 *
 * @package    datasol
 * @subpackage action
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 */
abstract class ActionsCrud extends sfActionsCrud
{
  public function executeShow(sfWebRequest $request)
  {
    $slug      = $request->getParameter('slug', '');
    $this->obj = Doctrine::getTable($this->modelClass)->findOneBySlug($slug);
    $this->forward404Unless($this->obj);
    
    $this->form = new $this->formClass($this->obj);
    $this->form = new sfShowableForm($this->form);
  }
}
