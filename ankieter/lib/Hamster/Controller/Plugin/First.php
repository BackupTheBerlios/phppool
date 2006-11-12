<?php

class Hamster_Controller_Plugin_First extends Zend_Controller_Plugin_Abstract
{
	public $message;
	public $permission;
	public function routeShutdown($action)
	{	
        $user = Zend::registry('user');
        if($user->getPermission($action->getControllerName(),$action->getActionName())){
        	return $action;	
        } else {
        	$action->setControllerName('index');
        	$action->setActionName('unauthorized');
        	return $action;
        }
	}
	/**
	 * Called on every iteration of the dispatch loop, before execution
	 * is passed to the action controller.
	 */
	public function preDispatch($action)
	{
		return $action;
	}

	/**
	 * Similar to preDispatch() except called after the action controller
	 * has been invoked.
	 */
	public function postDispatch($action)
	{
		return $action;
	}

	/**
	 * Essentially means that there are no more controllers/actions left
	 * on the stack, so this should only ever be called ONCE (unless I'm missing something...).
	 */
	public function dispatchLoopShutdown()
	{
		
	
	}
}