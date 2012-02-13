<?php

/**
 * Profile actions.
 *
 * @package    std
 * @subpackage Profile
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfileActions extends ActionsCrud
{
  protected function complementList(sfWebRequest $request, DoctrineQuery $q)
  {
    Doctrine::getTable($this->modelClass)->getQueryForList($q);
  }

  protected function getExtraFilterAndArrangeFields()
  {
    $array_fields = array
                    (
                      'extra' => array('actions_number' => 'actions_number')
                     );
                    
    return $array_fields;  
  }
}