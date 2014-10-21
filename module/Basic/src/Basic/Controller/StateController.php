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
    const STATE_ENTITY = 'Basic\Entity\State';
    const STATE_CRUD_URL = '/basic/state/crud';
    
    /**
     * Ação inicial da tela de estado
     * 
     * @return type
     */
    public function indexAction() 
    {         
        return $this->redirect()->toRoute('state', array('action' => 'search'));
    }
    
    /**
     * Tela de busca por estado
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function searchAction()
    {         
        $grid = $this->getServiceLocator()->get('jqgrid')->setGridIdentity(self::STATE_ENTITY);
        $grid->setUrl(self::STATE_CRUD_URL);

        return array('grid' => $grid);
               
        //return new ViewModel();
    }
    
    /**
     * CRUD de estados.
     */
    public function crudAction()
    {
        $grid     = $this->getServiceLocator()->get('jqgrid')->setGridIdentity(self::STATE_ENTITY);
        $response = $grid->prepareGridData();

        echo json_encode($response);
        exit;
    }
    
    /**
     * Tela de novo registro para estado
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
