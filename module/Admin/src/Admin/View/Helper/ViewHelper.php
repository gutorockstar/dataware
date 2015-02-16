<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TecnonView
 *
 * @author augusto
 */
namespace Admin\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\ServerUrl;

class ViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    /**
     * Recebe EntityManager do Doctrine.
     * 
     * @var EntityManegr
     */
    protected $entityManager;
    
    public $serviceLocator;
	
    /**
     * Retorna uma Entidade de trabalho para doctrine.
     * 
     * @return EntityManager.
     */
    public function __construct(EntityManager $em) 
    {
        $this->entityManager = $em;      
    }
    
    public function getServiceLocator() 
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) 
    {
        $this->serviceLocator = $serviceLocator;
    }
    
    /**
     * Retorna uma Entidade de trabalho para doctrine.
     * 
     * @return EntityManager.
     */
    public function getEntityManager()
    {
        if ( !$this->entityManager ) 
        {
            $this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        
        return $this->entityManager;
    }
    
    /**
     * Cria nova view recebendo o conteúdo por parâmetro
     * 
     * @param String html $insideElements
     */
    public function __invoke($header = null, $viewContent = array(), $styles = array())
    {
        if ( count($styles) > 0 )
        {
            foreach ( $styles as $attribute => $value )
            {
                $style .= "{$attribute}:$value;";
            }
        }
        
        $view = "<fieldset style='{$style}'>
                     <legend>{$header}</legend>";
        
        if ( count($viewContent) > 0 )
        {
            foreach ( $viewContent as $content )
            {
                $view .= $content;
            }
        }
        else
        {
            $view .= "<p>Nenhum conteúdo encontrado...</p>";
        }
                    
        $view .= "</fieldset>";
        
        return $view;
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
     * Retorna a url completa da rota atual.
     * 
     * @return string
     */
    public function getCurrentRouteUrl()
    {
        $currentUrl = $this->getCurrentUrl();
        $expCurrentUrl = explode('/', $currentUrl);
        $baseUrl = $expCurrentUrl[0] . '//' . $expCurrentUrl[2] . '/';
        
        $sm = $this->getView()->getHelperPluginManager()->getServiceLocator();
        $router = $sm->get('Router');
        $request = $sm->get('Request');
        $routeMatch = $router->match($request);
        $viewRoute = $routeMatch->getParam('module') . '/' . $routeMatch->getMatchedRouteName() . '/';
        
        return $baseUrl . $viewRoute;
    }
}

?>
