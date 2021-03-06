<?php

/**
 * Log actions.
 *
 * @package    std
 * @subpackage Log
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LogActions extends ActionsProject
{
	public function executeLogin(sfWebRequest $request)
	{
		$this->form = new LoginBackendForm();
	
		if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter($this->form->getName()));
			if ($this->form->isValid())
			{
				$user = Doctrine::getTable('User')->findOneByLowerCaseUsername($this->form->getValue('username'));
				$this->getUser()->login($user);
	
				return $this->redirect('@record_list?record_status=100');
			}
		}
	}
	public function executeLogout()
	{
		if ($this->getUser()->isAuthenticated())
		{
			$this->getUser()->logout();
		}
	
		return $this->redirect('@log_login');
	}
}
