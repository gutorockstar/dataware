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
    
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

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
    
    public function indexAction()
    {
        
    }
    
    public function searchAction()
    {
        return new ViewModel();
    }
    
    public function crudAction()
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
