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
namespace Sysma;

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

                    return new View\Helper\Loading($em);
                },
                'Alert' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()
                             ->get('Doctrine\ORM\EntityManager');   				

                    return new View\Helper\Alert($em);
                },
                'Menu' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()
                             ->get('Doctrine\ORM\EntityManager');   				

                    return new View\Helper\Menu($em);
                },
                'View' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()
                             ->get('Doctrine\ORM\EntityManager');   				

                    return new View\Helper\View($em);
                },
                'Panel' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()
                             ->get('Doctrine\ORM\EntityManager');   				

                    return new View\Helper\Panel($em);
                },
                'Grid' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()
                             ->get('Doctrine\ORM\EntityManager');   				

                    return new View\Helper\Grid($em);
                },
                'Toolbar' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()
                             ->get('Doctrine\ORM\EntityManager');   				

                    return new View\Helper\Toolbar($em);
                }
            )
    	);
    }
}

?>
