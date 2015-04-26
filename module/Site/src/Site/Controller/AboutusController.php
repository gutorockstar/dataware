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

class AboutusController extends Controller
{
    public function aboutusAction()
    {
        return new ViewModel();
    }
}

?>
