<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Basic\Controller;

use Sysma\Controller\Controller;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder; 
use Basic\Entity\State;

class StateController extends Controller
{
    /**
     * Ação inicial da tela de país
     * 
     * @return type
     */
    public function indexAction() 
    {         
        return $this->redirect()->toRoute('state', array('action' => 'search'));
    }
    
    /**
     * Tela de busca por país
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function searchAction()
    {         
        return new ViewModel();
    }
    
    /**
     * Tela de novo registro para país
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function newAction()
    {        
        $State = new State();
        $builder = new AnnotationBuilder();

        $form = $builder->createForm($State);
        //$form->setInputFilter($State->getInputFilter());
         
        return array('form' => $form);
    }
    
    /**
     * Método controlador de inserts e updates
     */
    public function saveAction()
    {
        
    }
}
