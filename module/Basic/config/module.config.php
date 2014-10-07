<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonAdmin for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'controllers' => array(
        'invokables' => array(
            'Basic\Controller\CountryController' => 'Basic\Controller\CountryController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            
            // Rotas da manutenção de países.
            'country' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/country',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Basic\Controller',
                        'controller'    => 'CountryController',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
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
            
            'countrysearch' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/country/search',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Basic\Controller',
                        'controller'    => 'CountryController',
                        'action'        => 'search',
                    ),
                ),
            ),
            
            'countrynew' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/country/new',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Basic\Controller',
                        'controller'    => 'CountryController',
                        'action'        => 'new',
                    ),
                ),
            ),
            
            'countrysave' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/country/save',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Basic\Controller',
                        'controller'    => 'CountryController',
                        'action'        => 'save',
                    ),
                ),
            ),                      
        ),
    ),








    
    'doctrine' => array(
        'driver' => array(
            'basic_entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Basic/Entity')
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Basic\Entity' => 'basic_entities'
                )
            )
        )
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
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
