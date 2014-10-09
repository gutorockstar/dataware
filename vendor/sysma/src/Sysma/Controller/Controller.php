<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author augusto
 */
namespace Sysma\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;

class Controller extends AbstractActionController
{
    const ROUTE_DEFAULT = 'login';
    
    public function onDispatch(MvcEvent $e) 
    {
        if ( !$this->getServiceLocator()->get('AuthenticationService')->hasIdentity() )
        {
            $this->redirect()->toRoute(self::ROUTE_DEFAULT);
        }

        return parent::onDispatch($e);
    }
}

?>
