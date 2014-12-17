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
namespace Innerbridge\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Helper\ServerUrl;
use Zend\View\Model\ViewModel;

class Controller extends AbstractActionController
{
    const ROUTE_DEFAULT = 'login';
    
    protected $route;
    protected $entityName;
    protected $em;
    
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
        $this->getEvent()->getRouteMatch()->getParam("entity");
        
        
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
     * @return array|\Doctrine\ORM\EntityManager|object
     */
    public function getEntityManager()
    {
        if ( is_null($this->em) ) 
        {
            $this->em = $this->getServiceLocator()->get('ServiceLocator');
        }

        return $this->em;
    }
    
    /**
     * @param \Zend\Mvc\MvcEvent $e
     * @return mixed
     */
    public function onDispatch(MvcEvent $e) 
    {
        if ( !$this->getEntityManager()->hasIdentity() )
        {
            $this->redirect()->toRoute(self::ROUTE_DEFAULT);
        }

        return parent::onDispatch($e);
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
        $entity = $this->getEvent()->getRouteMatch()->getParam("entity");
        return $entity;
    }
    
    /**
     * Retorna o controlador atual.
     * 
     * @return String
     */
    public function getCurrentController()
    {
        $controller = $this->getEvent()->getRouteMatch()->getParam("controller");
        return $controller;
    }
    
    /**
     * Primeira ação a ser executada.
     * Por padrão, executa a ação de busca, responsável por carregar
     * a grid.
     */
    public function indexAction()
    {
        $this->redirect()->toRoute($this->getCurrentRoute(), array('action' => 'search'));
    }
    
    public function searchAction()
    {
        $grid = $this->getServiceLocator()->get('jqgrid')->setGridIdentity($this->getCurrentEntity());
        $grid->setUrl('/basic/state/find');

        return array('grid' => $grid);
    }
    
    public function findAction()
    {
        
    }
    
    public function newAction()
    {
        return new ViewModel();
    }
    
    public function editAction()
    {
        $data = $this->getRequest()->getPost();
        
        return new ViewModel();
    }
    
    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
    }
    
    public function deleteAction()
    {
        $data = $this->getRequest()->getPost();
    }
    
    public function printAction()
    {
        
    }
    
    public function backAction()
    {
        
    }
    
}

?>
