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
  protected function complementList(sfWebRequest $request, DoctrineQuery $q)
  {
    sfDynamicFormEmbedder::resetParams('document');
    
    Doctrine::getTable($this->modelClass)->updateQueryForList($q);
  }
    
}
