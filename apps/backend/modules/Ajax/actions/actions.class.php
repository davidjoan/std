<?php

/**
 * Ajax actions.
 *
 * @package    std
 * @subpackage Ajax
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AjaxActions extends ActionsProject
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeNotify(sfWebRequest $request)
  {
    $qty_record = Doctrine::getTable('Record')->qtyOfRecords();
    return $this->renderJson(array('qty' => $qty_record));
  }
  


    
}
