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
namespace Innerbridge\Entity;

class Toolbar 
{
    const ID_OPTION_NEW = 1;
    const ID_OPTION_SEARCH = 2;
    const ID_OPTION_PRINT = 4;
    const ID_OPTION_BACK = 5;
    
    const TITLE_OPTION_NEW = 'Novo';
    const TITLE_OPTION_SEARCH = 'Procurar';
    const TITLE_OPTION_PRINT = 'Imprimir';
    const TITLE_OPTION_BACK = 'Voltar';
    
    const ACTION_OPTION_NEW = 'add_grid_';
    const ACTION_OPTION_SEARCH = 'add_grid_';
    const ACTION_OPTION_PRINT = 'add_grid_';
    const ACTION_OPTION_BACK = 'add_grid_';
    
    const CSS_CLASS_ICON_OPTION_NEW = 'fa-file-o';
    const CSS_CLASS_ICON_OPTION_SEARCH = 'fa-search';
    const CSS_CLASS_ICON_OPTION_PRINT = 'fa-print';
    const CSS_CLASS_ICON_OPTION_BACK = 'fa-arrow-circle-o-left';
    
    const METHOD_ACTION_AJAX = 'ajax';
    const METHOD_ACTION_POST = 'post';
    
    private $toolbarOptions = array();
    
    public function __construct($toolbarOptions)
    {
        $this->toolbarOptions = $toolbarOptions;
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
