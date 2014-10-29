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

use Innerbridge\Controller\Controller;

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
        return $this->redirect()->toRoute('country', array('action' => 'search'));
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
        $options['fieldName'] = $this->params()->fromRoute('state', null);
        
        $grid     = $this->getServiceLocator()->get('jqgrid')->setGridIdentity(self::ENTITY_NAMESPACE);
        $response = $grid->prepareGridData($this->getRequest(), $options);

        echo json_encode($response);
        exit;
    }
}

?>
