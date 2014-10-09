<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CountryController
 *
 * @author augusto
 */
namespace Basic\Controller;

use Sysma\Controller\Controller;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder; 
use Basic\Entity\Country;

class CountryController extends Controller
{
    /**
     * Ação inicial da tela de país
     * 
     * @return type
     */
    public function indexAction() 
    {         
        return $this->redirect()->toRoute('country', array('action' => 'search'));
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
     * @return array
     */
    public function newAction()
    {        
        $Country = new Country();
        $builder = new AnnotationBuilder();

        $form = $builder->createForm($Country);
        //$form->setInputFilter($Country->getInputFilter());
         
        return array('form' => $form);
    }
}

?>
