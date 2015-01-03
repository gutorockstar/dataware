<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Basic\Controller;

use Admin\Controller\Controller;

class StateController extends Controller
{    
    public function indexAction()
    {
        //$this->redirect()->toRoute($this->getCurrentRoute(), array('action' => 'search'));
        
        $grid = $this->getServiceLocator()->get(parent::SERVICE_JQGRID_LOCATOR)->setGridIdentity($this->getCurrentEntity());
        $grid->setUrl('/basic/state/crud');

        return array('grid' => $grid);
    }
    
    /**
     * Executa as ações de inserção, edição, exclusão, e busca.
     * 
     * @param array $options
     */
    public function crudAction()
    {
        $options['fieldName'] = $this->params()->fromRoute('country', null);
        $grid = $this->getServiceLocator()->get(parent::SERVICE_JQGRID_LOCATOR)->setGridIdentity($this->getCurrentEntity());
        $response = $grid->prepareGridData($this->getRequest(), $options);

        echo json_encode($response);
        exit;
    }
}
