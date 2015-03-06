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

use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Helper\ServerUrl;
use Zend\View\Model\ViewModel;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class Controller extends AbstractActionController
{
    const SERVICE_LOCATOR = 'ServiceLocator';
    const SERVICE_JQGRID_LOCATOR = 'jqgrid';
    const ROUTE_DEFAULT = 'login';
    const ENTITY_PARAM = 'entity';
    const CONTROLLER_PARAM = 'controller';
    const CRUD_URL_PARAM = 'crud_url';
    
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
    
    /**
     * Primeira ação a ser executada.
     * Por padrão, executa a ação de busca, responsável por carregar
     * a grid.
     */
    public function indexAction()
    {
        $dataGrid = $this->getObjectManager()->getRepository($this->getCurrentEntity())->findAll();

        return new ViewModel(array('dataGrid' => $dataGrid));
    }
    
    /**
     * Ação padrão para adicionar novos registros.
     */
    public function addAction()
    {
        $entityClass = $this->getCurrentEntity();
        $entity = new $entityClass();
            
        if ( $this->request->isPost() ) 
        {
            $this->populateEntity($entity);

            $this->getObjectManager()->persist($entity);
            $this->getObjectManager()->flush();
            $id = $entity->getId();

            return $this->redirect()->toRoute($this->getCurrentRoute(), array('id' => $id));
        }
        
        $builder  = new AnnotationBuilder();    
        $form = $builder->createForm($entity);
        
        return array('form' => $form);
    }
    
    /**
     * Ação padrão para edição de registros.
     */
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        $entityClass = $this->getCurrentEntity();
        $entity = $this->getObjectManager()->find($entityClass, $id);

        if ( $this->request->isPost() ) 
        {
            $this->populateEntity($entity);

            $this->getObjectManager()->persist($entity);
            $this->getObjectManager()->flush();

            return $this->redirect()->toRoute($this->getCurrentRoute());
        }
        
        $builder  = new AnnotationBuilder();    
        $form = $builder->createForm($entity);
        $form->setHydrator(new DoctrineHydrator($this->getObjectManager(), $entityClass));
        $form->bind($entity);

        return array('form' => $form);
    }
    
    /**
     * Ação padrão de exclusão de registros.
     * 
     * 
     *   PENSAR EM FAZER AS VIEWS PADRÕES .phtml !!!!!!!!
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        $entityClass = $this->getCurrentEntity();
        $entity = $this->getObjectManager()->find($entityClass, $id);

        if ( $this->request->isPost() ) 
        {
            $this->getObjectManager()->remove($entity);
            $this->getObjectManager()->flush();

            return $this->redirect()->toRoute($this->getCurrentRoute());
        }

        
        $this->flashMessenger()->addWarningMessage("Este registro será excluído, e você não terá mais acesso a ele. Deseja realmente excluí-lo?");
    }
    
    /**
     * Ação padrão de visualização de registros.
     */
    public function viewAction()
    {
    }
    
    /**
     * Ação padrão de impressão de registros.
     */
    public function printAction()
    {   
    }
    
    /**
     * Ação padrão para voltar.
     */
    public function backAction()
    {
    }
}

?>
