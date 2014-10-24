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

class CountryController extends Controller
{
    const ENTITY_NAMESPACE = 'Basic\Entity\Country';
    const CRUD_URL = '/basic/country/crud';
    
    /**
     * Ação inicial da tela de país
     * 
     * @return type
     */
    public function indexAction() 
    {   
        $args = array(
            'module' => 'basic', 
            'action' => 'search'
        );
        
        return $this->redirect()->toRoute('country', $args);
    }
    
    /**
     * Tela de busca por país
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
     * CRUD de países.
     */
    public function crudAction()
    {
        $grid     = $this->getServiceLocator()->get('jqgrid')->setGridIdentity(self::ENTITY_NAMESPACE);
        $response = $grid->prepareGridData();

        return new JsonModel($response);
    }
}

?>
