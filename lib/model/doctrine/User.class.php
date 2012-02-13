<?php

/**
 * User
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    std
 * @subpackage model
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class User extends BaseUser
{
  public function getActiveStr()
  {
    $actives = $this->getTable()->getStatuss();
    return $actives[$this->getActive()];
  }
	
  public function setPassword($password)
  {
    $this->_set('password', kcCrypt::encrypt($password));
  }
  


  public function getName()
  {
  	return sprintf('%s, %s', $this->getLastName(), $this->getFirstName());
  }

  public function getProfileName()
  {
  	return $this->getProfile() ? $this->getProfile()->getName() : '';
  }
  public function getActions()
  {
    return $this->getProfile()->getActions();
  }
  public function getLastAccessAtFormatedByProfile($format = 'M-d-y H:i')
  {
  	return ($this->getProfileId() != 1) ? $this->getLastAccessAt($format) : 'hidden';
  }  
}