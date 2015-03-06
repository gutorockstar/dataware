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
namespace System\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Helper\ServerUrl;

class Controller extends AbstractActionController
{
    const SERVICE_LOCATOR = 'ServiceLocator';
    const SERVICE_JQGRID_LOCATOR = 'jqgrid';
    const ROUTE_DEFAULT = 'login';
    const ENTITY_PARAM = 'entity';
    const CONTROLLER_PARAM = 'controller';
    const MODULE_PARAM = 'module';
    
    const MODULE_SITE = 'site';
    const MODULE_ADMIN = 'admin';
    const MODULE_SYSTEM = 'system';
    
    protected $route;
    protected $entityName;
    protected $em;
    protected $_objectManager;

    public function getRoute() 
    {
        return $this->route;
    }

    public function setRoute($route) 
    {
        $this->route = $route;
    }
    
    public function getEntityName() 
    {
        $this->getEvent()->getRouteMatch()->getParam(self::ENTITY_PARAM);
        
        
        return $this->entityName;
    }

    public function setEntityName($entityName) 
    {
        $this->entityName = $entityName;
    }
    
    /**
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Retorna administrador de entidades para autenticação.
     * 
     * @return array|\Doctrine\ORM\EntityManager|object
     */
    public function getEntityManager()
    {
        if ( is_null($this->em) ) 
        {
            $this->em = $this->getServiceLocator()->get(self::SERVICE_LOCATOR);
        }

        return $this->em;
    }
    
    /**
     * Retorna administrador de entidades para consultas diversas.
     * 
     * @return array|\Doctrine\ORM\EntityManager|object
     */
    protected function getObjectManager()
    {
        if ( !$this->_objectManager ) 
        {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
    
    /**
     * @param \Zend\Mvc\MvcEvent $e
     * @return mixed
     */
    public function onDispatch(MvcEvent $e) 
    {
        if ( $this->getCurrentModule() != self::MODULE_SITE )
        {
            if ( !$this->getEntityManager()->hasIdentity() )
            {
                $this->redirect()->toRoute(self::ROUTE_DEFAULT);
            }
        }

        return parent::onDispatch($e);
    }
    
    /**
     * Retorna o módulo atual da rota.
     * 
     * @return String
     */
    public function getCurrentModule()
    {
        $entity = $this->getEvent()->getRouteMatch()->getParam(self::MODULE_PARAM);
        return $entity;
    }
    
    /**
     * Retorna a url atual.
     * 
     * @return String
     */
    public function getCurrentUrl()
    {
        $serverUrl = new ServerUrl();
        $currentUrl = $serverUrl->__invoke(true);
        
        return $currentUrl;
    }
    
    /**
     * Retorna a rota atual.
     * 
     * @return String
     */
    public function getCurrentRoute()
    {   
        $route = $this->getEvent()->getRouteMatch()->getMatchedRouteName();
        return $route;
    }
    
    /**
     * Retorna a entidade atual.
     * 
     * @return String
     */
    public function getCurrentEntity()
    {
        $entity = $this->getEvent()->getRouteMatch()->getParam(self::ENTITY_PARAM);
        return $entity;
    }
    
    /**
     * Retorna o controlador atual.
     * 
     * @return String
     */
    public function getCurrentController()
    {
        $controller = $this->getEvent()->getRouteMatch()->getParam(self::CONTROLLER_PARAM);
        return $controller;
    }
    
    /**
     * Popula os atributos de uma entidade, com os
     * valores recebidos pelo post.
     * 
     * @param type $entity
     */
    private function populateEntity($entity)
    {
        $postData = $this->getRequest()->getPost()->toArray();
            
        foreach ( $postData as $attribute => $data )
        {
            $lowerAttribute = strtolower($attribute);
            $setFunction = "set" . ucfirst($lowerAttribute);

            if ( method_exists($entity, $setFunction) )
            {
                $entity->$setFunction($data);
            }
        }
    }
}

?>
