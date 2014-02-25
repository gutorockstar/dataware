<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Article\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Form\Annotation\AnnotationBuilder; 
use Article\Entity\ArtCategory;

class ArtCategoryController extends AbstractActionController
{
    /**
     * Ação inicial da tela de categorias e subcategorias.
     * 
     * @return type
     */
    public function indexAction() 
    {
        if ( !$this->getServiceLocator()->get('AuthenticationService')->hasIdentity() )
        {
            $this->redirect()->toRoute('login');
        }
         
        return $this->redirect()->toRoute('categorysearch');
    }
    
    /**
     * Tela de busca por categorias e subcategorias.
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
     * Tela de novo registro para categorias e subcategorias.
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function newAction()
    {
        if ( !$this->getServiceLocator()->get('AuthenticationService')->hasIdentity() )
        {
            $this->redirect()->toRoute('login');
        }
        
        $ArtCategory = new ArtCategory();
        $builder     = new AnnotationBuilder();

        $form = $builder->createForm($ArtCategory);
        //$form->setInputFilter($ArtCategory->getInputFilter());
         
        return array('form' => $form);
    }
}
