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
        return new ViewModel();
    }
}

?>
