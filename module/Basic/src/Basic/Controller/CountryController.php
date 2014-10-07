<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Basic\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Form\Annotation\AnnotationBuilder; 
use Basic\Entity\Country;

class CountryController extends AbstractActionController
{
    /**
     * Ação inicial da tela de país
     * 
     * @return type
     */
    public function indexAction() 
    {
        if ( !$this->getServiceLocator()->get('AuthenticationService')->hasIdentity() )
        {
            $this->redirect()->toRoute('login');
        }
         
        return $this->redirect()->toRoute('countrysearch');
    }
    
    /**
     * Tela de busca por país
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function searchAction()
    {
        if ( !$this->getServiceLocator()->get('AuthenticationService')->hasIdentity() )
        {
            $this->redirect()->toRoute('login');
        }
         
        return new ViewModel();
    }
    
    /**
     * Tela de novo registro para país
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function newAction()
    {
        if ( !$this->getServiceLocator()->get('AuthenticationService')->hasIdentity() )
        {
            $this->redirect()->toRoute('login');
        }
        
        $Country = new Country();
        $builder = new AnnotationBuilder();

        $form = $builder->createForm($Country);
        //$form->setInputFilter($Country->getInputFilter());
         
        return array('form' => $form);
    }
    
    /**
     * Método controlador de inserts e updates
     */
    public function saveAction()
    {
        
    }
}
