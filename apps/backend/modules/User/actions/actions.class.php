<?php

/**
 * User actions.
 *
 * @package    std
 * @subpackage User
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserActions extends ActionsCrud
{
  protected function complementList(sfWebRequest $request, DoctrineQuery $q)
  {
    Doctrine::getTable($this->modelClass)->getQueryForList($q);
  }
  
  protected function getExtraFilterAndArrangeFields()
  {
    $array_fields = array
                    (
                      'p' => array('name_perfil' => 'name'),
                      'a' => array('name_area' => 'name'),
                      'extra' => array('user_image' => 'user_image')
                    );
                    
    return $array_fields;    
  }  
}
