<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonAdmin for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Site;

return array(
    'controllers' => array(
        'invokables' => array(
            'Site\Controller\HomeController' => 'Site\Controller\HomeController',
            'Site\Controller\ProductsController' => 'Site\Controller\ProductsController',
            'Site\Controller\AboutusController' => 'Site\Controller\AboutusController',
            'Site\Controller\ContactController' => 'Site\Controller\ContactController'
        ),
    ),
    
    'router' => array(
        'routes' => array(
            
            'home' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'constraints' => array(
                        'action' => '[a-zA-Z]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Site\Controller',
                        'controller'    => 'HomeController',
                        'action'        => 'home',
                        'module' => 'site'
                    ),
                ),
            ),
            
            'products' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/products',
                    'constraints' => array(
                        'category' => '[0-9]+',
                        'product' => '[0-9]+'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Site\Controller',
                        'controller'    => 'ProductsController',
                        'action'        => 'products',
                        'module' => 'site'
                    ),
                ),
            ),
            
            'aboutus' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/aboutus',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Site\Controller',
                        'controller'    => 'AboutusController',
                        'action'        => 'aboutus',
                        'module' => 'site'
                    ),
                ),
            ),
            
            'contact' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/contact',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Site\Controller',
                        'controller'    => 'ContactController',
                        'action'        => 'contact',
                        'module' => 'site'
                    ),
                ),
            ),
        ),
    ), 
    
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),
    ),
    
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    
    'translator' => array(
        'locale' => 'pt_BR',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/site.phtml',
            'site/home/home' => __DIR__ . '/../view/site/home/home.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
