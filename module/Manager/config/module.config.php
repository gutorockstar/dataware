<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonManager for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Manager;

return array(
    'controllers' => array(
        'invokables' => array(
            'Manager\Controller\ManagerController' => 'Manager\Controller\ManagerController',
            'Manager\Controller\CategoryController' => 'Manager\Controller\CategoryController',
            'Manager\Controller\BrandController' => 'Manager\Controller\BrandController',
            'Manager\Controller\ProductController' => 'Manager\Controller\ProductController',
            'Manager\Controller\CompanymissionviewController' => 'Manager\Controller\CompanymissionviewController'
        ),
    ),
    
    'router' => array(
        'routes' => array(
            
            'manager' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/manager',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Manager\Controller',
                        'controller'    => 'ManagerController',
                        'action'        => 'start',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ), 
            
            // Rota para as interfaces de manutenção de Categorias.
            'category' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/manager/category[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z]*',
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Manager\Controller',
                        'entity' => 'Manager\Entity\Category',
                        'controller' => 'Manager\Controller\CategoryController',
                        'module' => 'manager',
                        'action' => 'index',
                        'caption' => 'Categorias',
                        
                        // Custom templates
                        'template' => array(
                            'index' => 'system/crud',
                            'add' => 'system/crud',
                            'edit' => 'system/crud',
                            'delete' => 'system/crud'
                        )
                    ),
                ),
            ),
            
            // Rota para as interfaces de manutenção de Marcas.
            'brand' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/manager/brand[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z]*',
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Manager\Controller',
                        'entity' => 'Manager\Entity\Brand',
                        'controller' => 'Manager\Controller\BrandController',
                        'module' => 'manager',
                        'action' => 'index',
                        'caption' => 'Marcas',
                        
                        // Custom templates
                        'template' => array(
                            'index' => 'system/crud',
                            'add' => 'system/crud',
                            'edit' => 'system/crud',
                            'delete' => 'system/crud'
                        )
                    ),
                ),
            ),
            
            // Rota para as interfaces de manutenção de Produtos.
            'product' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/manager/product[/:action][/:id][/:attachment]',
                    'constraints' => array(
                        'action' => '[a-zA-Z]*',
                        'id' => '[0-9]+',
                        'attachment' => '[a-zA-Z]*[0-9]+'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Manager\Controller',
                        'entity' => 'Manager\Entity\Product',
                        'controller' => 'Manager\Controller\ProductController',
                        'module' => 'manager',
                        'action' => 'index',
                        'caption' => 'Produtos',
                        
                        // Custom templates
                        'template' => array(
                            'index' => 'system/crud',
                            'add' => 'system/crud',
                            'edit' => 'system/crud',
                            'delete' => 'system/crud',
                            'attachments' => 'system/crud'
                        )
                    ),
                ),
            ), 
            
            // Rota para as interfaces de manutenção de Produtos.
            'companymissionview' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/manager/companymissionview[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z]*',
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Manager\Controller',
                        'entity' => 'Manager\Entity\Companymissionview',
                        'controller' => 'Manager\Controller\CompanymissionviewController',
                        'module' => 'manager',
                        'action' => 'index',
                        'caption' => 'Empresa, Missão e Visão'
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
            'layout/layout'           => __DIR__ . '/../view/layout/system.phtml',
            'manager/index/index' => __DIR__ . '/../view/manager/manager/start.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
