<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonAdmin for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Basic;

return array(
    'controllers' => array(
        'invokables' => array(
            'Basic\Controller\CountryController' => 'Basic\Controller\CountryController',
            'Basic\Controller\StateController' => 'Basic\Controller\StateController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            
            // Rota para as interfaces de manutenção de Países.
            'country' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/basic/country[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Basic\Controller',
                        'entity' => 'Basic\Entity\Country',
                        'controller' => 'Basic\Controller\CountryController',
                        'action' => 'index',
                    ),
                ),
            ),
            
            // Rota para as interfaces de manutenção de Estados.
            'state' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/basic/state[/:action][/:fieldName]',
                    'constraints' => array(
                        'module' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'fieldName' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Basic\Controller',
                        'entity' => 'Basic\Entity\State',
                        'controller' => 'Basic\Controller\StateController',
                        'action' => 'index',
                        'crud_url' => '/basic/state/crud'
                    ),
                ),
            ), 
            
        ),
    ),
    
    'jqgrid' => array(
        'column_model' => array(
            'title' => array(
                'align' => 'left',
                'label' => 'titulo'
                /**
                'formatter' => new \Zend\Json\Expr(""),
                'unformat' => new \Zend\Json\Expr(""),
                
                'editoptions' => array(
                    'custom_element' => new \Zend\Json\Expr(""),
                    'custom_value' => 
                )
                 * 
                 */
            ),
            
            'Country' => array(
                'isSubGridAsGrid' => true
            ),
            'States' => array(
                'isSubGridAsGrid' => true
            ),
        ),
        
        // PARA REGISTROS QUE POSSUEM RELACIONAMENTOS.
        /**
        'grid_url_generator' => function ($sm, $entity, $fieldName, $targetEntity, $urlType) {
    
            exit($targetEntity);
            switch($urlType)
            {                
                case BaseGrid::DYNAMIC_URL_TYPE_ROW_EXPAND:   
                    $helper = $sm->get('viewhelpermanager')->get('url');
                    $url    = $helper('country', array('action' => 'crud', 'fieldName' => $fieldName));
                    echo $fieldName;
                    
                    return new \Zend\Json\Expr("'" . $url . "?subgridid='+row_id");
            }
        }
         * 
         */
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
