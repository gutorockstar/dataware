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
namespace Tecnon;

class Module 
{
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
    
    public function getViewHelperConfig()
    {
    	return array(
            'factories' => array(
                'Loading' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()
                             ->get('Doctrine\ORM\EntityManager');   				

                    return new View\Loading($em);
                },
                'Alert' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()
                             ->get('Doctrine\ORM\EntityManager');   				

                    return new View\Alert($em);
                },
                'Menu' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()
                             ->get('Doctrine\ORM\EntityManager');   				

                    return new View\Menu($em);
                },
                'Panel' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()
                             ->get('Doctrine\ORM\EntityManager');   				

                    return new View\Panel($em);
                },
                'Grid' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()
                             ->get('Doctrine\ORM\EntityManager');   				

                    return new View\Grid($em);
                }
            )
    	);
    }
}

?>
