<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author augusto
 */
namespace Site\Controller;

use System\Controller\Controller;
use Zend\View\Model\ViewModel;

class ProductsController extends Controller
{
    public function productsAction()
    {
        $request = $this->getRequest();
        
        if ( $request->isPost() ) 
        {
            $postData = $request->getPost()->toArray();
            return $this->redirect()->toRoute('products', array(), array('query' => $postData));
        }
        
        $id = (int) $this->params()->fromRoute('id', 0);
        $categoryId = (int) $this->params()->fromRoute('category_id', 0);
        
        return new ViewModel(array('id' => $id, 'category_id' => $categoryId));
    }
}

?>
