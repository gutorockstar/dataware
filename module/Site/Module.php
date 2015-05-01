<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Site;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Authentication\Storage;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class Module
{
    const ENTITY_MANAGER = 'Doctrine\ORM\EntityManager';
    
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

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
                'ServiceLocator' => function($sm) 
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
                'SiteHeaderHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\SiteHeaderHelper($em);
                },
                     
                'SiteContentHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\SiteContentHelper($em);
                },
                        
                'SiteFooterHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\SiteFooterHelper($em);
                },
                        
                'SiteLogoHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\SiteLogoHelper($em);
                },
                        
                'SiteMenuHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\SiteMenuHelper($em);
                },
                        
                'SiteBannerHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\SiteBannerHelper($em);
                },
                        
                'SiteFeaturedProductsHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\SiteFeaturedProductsHelper($em);
                },
                        
                'SiteProductBriefHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\SiteProductBriefHelper($em);
                },
                        
                'SiteCategorysTreeHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\SiteCategorysTreeHelper($em);
                },
                        
                'SiteActiveProductsHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\SiteActiveProductsHelper($em);
                },
                        
                'SiteMiniPanelHelper' => function ($sm) 
                {
                    $em = $sm->getServiceLocator()->get(Module::ENTITY_MANAGER);
                    return new View\Helper\SiteMiniPanelHelper($em);
                },
            )
        );
    }
}
