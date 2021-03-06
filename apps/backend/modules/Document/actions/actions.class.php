<?php

/**
 * Document actions.
 *
 * @package    std
 * @subpackage Document
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentActions extends ActionsCrud
{
  protected function complementList(sfWebRequest $request, DoctrineQuery $q)
  {
    Doctrine::getTable($this->modelClass)->updateQueryForList($q, $request->getParameterHolder()->getAll());
  }    
}
