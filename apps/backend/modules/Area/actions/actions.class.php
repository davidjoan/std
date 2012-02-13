<?php

/**
 * Area actions.
 *
 * @package    std
 * @subpackage Area
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AreaActions extends ActionsCrud
{
  protected function getExtraFilterAndArrangeFields()
  {
    return array
    (
      't'  => array('representative_name' => 'representative_name'),
    );
  }	
  protected function complementList(sfWebRequest $request, DoctrineQuery $q)
  {
    Doctrine::getTable($this->modelClass)->updateQueryForList($q);
  }

}
