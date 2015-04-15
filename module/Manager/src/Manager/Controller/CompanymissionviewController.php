<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompanyMissionViewController
 *
 * @author augusto
 */
namespace Manager\Controller;

use System\Controller\CrudController;
use Zend\View\Model\ViewModel;

class CompanymissionviewController extends CrudController
{
    public function indexAction() 
    {
        return new ViewModel();
    }
}

?>
