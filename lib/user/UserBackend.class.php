<?php

/**
 * UserBackend.
 *
 * @package    std
 * @subpackage lib.user
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 */
class UserBackend extends UserProject
{
  public function setAuthenticated($authenticated)
  {
    if ($this->options['logging'])
    {
      $this->dispatcher->notify(new sfEvent($this, 'application.log', array(sprintf('User is %sauthenticated', $authenticated === true ? '' : 'not '))));
    }

    $user = Doctrine::getTable('User')->find($this->getUserId());
    

    if ($authenticated === true)
    {
      $this->authenticated = true;
      $this->mapPermissions($user);
    }
    else
    {
      $this->authenticated = false;
      //$this->clearCredentials();

      $this->getAttributeHolder()->removeNamespace(ActionsProject::REPRESENTATIVE_NAMESPACE);
      $this->getAttributeHolder()->removeNamespace(ActionsProject::DOCUMENT_CLASS_NAMESPACE);
      $this->getAttributeHolder()->removeNamespace(ActionsProject::DOCUMENT_NAMESPACE);
      $this->getAttributeHolder()->removeNamespace(ActionsProject::PROFILE_NAMESPACE);
      $this->getAttributeHolder()->removeNamespace(ActionsProject::USER_NAMESPACE);
      $this->getAttributeHolder()->removeNamespace(ActionsProject::PROFILE_NAMESPACE);
      $this->getAttributeHolder()->removeNamespace(ActionsProject::CRUD_NAMESPACE);
      $this->getAttributeHolder()->removeNamespace(ActionsProject::ERROR_NAMESPACE);
      $this->getAttributeHolder()->removeNamespace(ActionsProject::GENERAL_NAMESPACE);
      $this->getAttributeHolder()->removeNamespace(ActionsProject::GENERIC_NAMESPACE);
      $this->getAttributeHolder()->removeNamespace(ActionsProject::HOME_NAMESPACE);
      $this->getAttributeHolder()->removeNamespace(ActionsProject::LOG_NAMESPACE);      
    }

    $this->storage->regenerate(false);
  }

  public function isAuthenticated()
  {
    return $this->authenticated;
  }

  public function getPermissions()
  {
    return $this->getAttribute('permissions'      , null, ActionsProject::USER_NAMESPACE);
  }
  protected function mapPermissions($user)
  {
    $permissions = $this->getActionsFromRole($user->getProfile());

    $this->setAttribute('permissions', $permissions, ActionsProject::USER_NAMESPACE);
  }
  protected function getActionsFromRole($profile)
  {
    $actions = $this->getActions($profile->getActions());
    return $actions;
  }

  protected function getActions($actions_profile)
  {
    $actions = array();
    foreach($actions_profile as $action_profile)
    {
      $actions[$action_profile->getRoute()] = true;
    }

    return $actions;
  }

  public function hasPermissions($route_names, $strict = false)
  {
    foreach ($route_names as $route_names)
    {
      if ($this->hasPermission($route_names))
      {
        if (!$strict)
        {
          return true;
        }
      }
      else
      {
        if ($strict)
        {
          return false;
        }
      }
    }

    if ($strict)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  public function hasPermission($route_name)
  {
    $route_name = trim($route_name, '@');
    $routes = sfContext::getInstance()->getRouting()->getRoutes();
    if (isset($routes[$route_name]))
    {
      $defaults  = $routes[$route_name]->getDefaults();
      $secure    = isset($defaults['secure']) ? $defaults['secure'] : true;
    }
    else
    {
      $secure = true;
    }

    $permissions = $this->getPermissions();
    if (!$secure || isset($permissions[$route_name]))
    {
      return true;
    }

    return false;
  }
  
}
