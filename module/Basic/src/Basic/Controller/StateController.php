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
     * Tela de busca por estado
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function crudAction()
    {   
        $options['fieldName'] = $this->params()->fromRoute('country', null);
        parent::crudAction($options);
    }
}
