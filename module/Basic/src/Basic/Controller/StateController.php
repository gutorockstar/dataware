<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Basic\Controller;

use Innerbridge\Controller\Controller;

class StateController extends Controller
{    
    /**
     * CRUD de estados.
     */
    public function searchAction()
    {
        $grid = $this->getServiceLocator()->get('jqgrid')->setGridIdentity('Basic\Entity\State');
        $grid->setUrl('/basic/state/find');

        return array('grid' => $grid);
    }
    
    /**
     * Tela de busca por estado
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function findAction()
    {   
        $options['fieldName'] = $this->params()->fromRoute('country', null);
        
        $grid     = $this->getServiceLocator()->get('jqgrid')->setGridIdentity('Basic\Entity\State');
        $response = $grid->prepareGridData($this->getRequest(), $options);

        echo json_encode($response);
        exit;
    }
}
