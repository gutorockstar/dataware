<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Module
 *
 * @author augusto
 */
namespace Innerbridge;

class Module 
{
    const ENTITY_MANAGER = 'Doctrine\ORM\EntityManager';
    
    // include de arquivo para outras configuracoes
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
 
    // autoloader para namespaces
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'AuthenticationService' => function($sm) 
                {
                    return $sm->get('doctrine.authenticationservice.orm_default');
                }
            )
        );
    }
    
    public function getViewHelperConfig()
    {
    	return array(
            'factories' => array(
                'LoadingHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\LoadingHelper($em);
                },
                        
                'AlertHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\AlertHelper($em);
                },
                        
                'MenuHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\MenuHelper($em);
                },
                        
                'ViewHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\ViewHelper($em);
                },
                        
                'PanelHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\PanelHelper($em);
                },
                        
                'GridHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\GridHelper($em);
                },
                        
                'ToolbarHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);   				
                    return new View\Helper\ToolbarHelper($em);
                }
            )
    	);
    }
}

?>
