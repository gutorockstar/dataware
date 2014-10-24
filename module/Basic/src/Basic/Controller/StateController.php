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

class StateController extends Controller
{    
    const ENTITY_NAMESPACE = 'Basic\Entity\State';
    const CRUD_URL = '/basic/state/crud';
    
    /**
     * Ação inicial da tela de estado
     * 
     * @return type
     */
    public function indexAction() 
    {   
        $args = array(
            'module' => 'basic', 
            'action' => 'search'
        );
        
        return $this->redirect()->toRoute('state', $args);
    }
    
    /**
     * Tela de busca por estado
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function searchAction()
    {         
        $grid = $this->getServiceLocator()->get('jqgrid')->setGridIdentity(self::ENTITY_NAMESPACE);
        $grid->setUrl(self::CRUD_URL);

        return array('grid' => $grid);
    }
    
    /**
     * CRUD de estados.
     */
    public function crudAction()
    {
        $grid     = $this->getServiceLocator()->get('jqgrid')->setGridIdentity(self::ENTITY_NAMESPACE);
        $response = $grid->prepareGridData();

        return new JsonModel($response);
    }
}
