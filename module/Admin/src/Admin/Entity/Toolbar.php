<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Toolbar
 *
 * @author augusto
 */
namespace Admin\Entity;

class Toolbar 
{    
    private $toolbarOptions = array();
    
    public function __construct($toobarOptions = array())
    {
        $this->toolbarOptions = $toobarOptions;
    }
    
    public function getToolbarOptions() 
    {
        return $this->toolbarOptions;
    }

    public function setToolbarOptions(Array $toolbarOptions) 
    {
        $this->toolbarOptions = $toolbarOptions;
    }
}

?>
