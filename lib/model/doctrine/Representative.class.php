<?php

/**
 * Representative
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    std
 * @subpackage model
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Representative extends BaseRepresentative
{
  public function __toString() 
  {
    return sprintf("%s %s",$this->getFirstname(), $this->getLastname() );
  }
  
}