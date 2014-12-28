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

use Admin\Controller\Controller;

class CountryController extends Controller
{    
    /**
     * CRUD de países.
     */
    public function crudAction()
    {
        $options['fieldName'] = $this->params()->fromRoute('state', null);
        parent::crudAction($options);
    }
}

?>
