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
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Form\Form;
use Zend\Form\Element\Select;

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
     * @param ORM/Object $entity
     * @param array $data
     */
    protected function populateEntity($entity, $data)
    {    
        $builder = new AnnotationBuilder();    
        $form = $builder->createForm($entity);
        
        // Percorre os dados dos atributos recebidos.
        foreach ( $data as $attribute => $value )
        {
            // Percorre os attributos da entidade, para reconhecimento de elementos especiais.
            foreach ( $form->getElements() as $element )
            {
                if ( ($element instanceof Select) && (!is_null($element->getOption('entity'))) && ($element->getAttribute('name') == $attribute) )
                {                    
                    $entityName = $element->getOption('entity'); // Obter o namespace da entidade relacional do atributo.
                    $entityRep = $this->getObjectManager()->getRepository($entityName);
                    $value = $entityRep->findOneBy(array('id' => $value));
                    
                    break;
                }
            }
            
            $lowerAttribute = strtolower($attribute);
            $setFunction = "set" . ucfirst($lowerAttribute);

            if ( method_exists($entity, $setFunction) )
            {
                $entity->$setFunction($value);
            }
        }
    }
    
    /**
     * Ajusta os elementos especiais do formulário,
     * como por exemplo os campos de tipo select, que
     * deverão listar todos os registros de uma entidade
     * por padrão.
     * 
     * @param \Zend\Form\Form $form
     */
    protected function adjustOfSpecialElements(Form $form)
    {
        foreach ( $form->getElements() as $element )
        {
            if ( $element instanceof Select && !is_null($element->getOption('entity')) )
            {
                // Obtém os registros de listagens padrões, a partir da entidade definida para o campo.
                $results = $this->getListValuesToSelectElement($element);
                $listValues = array(null => null);
        
                foreach ( $results as $result )
                {
                    $listValues[$result['id']] = $result['title'];
                }
                
                $form->get($element->getAttribute('name'))->setValueOptions($listValues);
            }
        }
    }
            
    /**
     * Retorna todos os registros para serem populados em campos de tipo select,
     * conforme registros padrões 'id' e 'title'.
     * 
     * @param Select $element
     * @return array
     */
    public function getListValuesToSelectElement(Select $element)
    {
        $entity = $element->getOption('entity');
        
        $repository = $this->getObjectManager()->getRepository($entity);
        $query = $repository->createQueryBuilder('list')
                            ->select("list.id, list.title")
                            ->orderBy("list.title")
                            ->getQuery();        
        
        return $query->getResult();
    }
}

?>
