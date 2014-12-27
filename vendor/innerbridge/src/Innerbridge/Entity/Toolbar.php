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
    const ID_OPTION_NEW = 'add_grid_';
    const ID_OPTION_VIEW = 'view_grid_';
    const ID_OPTION_SEARCH = 'search_grid_';
    const ID_OPTION_REFRESH = 'refresh_grid_';
    const ID_OPTION_FILTER = 'nav_filter-toolbar';
    const ID_OPTION_PRINT = 'print_grid_';
    const ID_OPTION_BACK = 'back_grid_';
    
    const TITLE_OPTION_NEW = 'Novo registro';
    const TITLE_OPTION_VIEW = 'Visualizar informações do registro';
    const TITLE_OPTION_SEARCH = 'Procurar registro';
    const TITLE_OPTION_REFRESH = 'Atualizar listagem';
    const TITLE_OPTION_FILTER = 'Esconder/mostrar filtros';
    const TITLE_OPTION_PRINT = 'Imprimir listagem';
    const TITLE_OPTION_BACK = 'Voltar';
    
    const ACTION_OPTION_NEW = 'new';
    const ACTION_OPTION_VIEW = 'view';
    const ACTION_OPTION_SEARCH = 'search';
    const ACTION_OPTION_REFRESH = 'refresh';
    const ACTION_OPTION_FILTER = 'filter';
    const ACTION_OPTION_PRINT = 'print';
    const ACTION_OPTION_BACK = 'back';
    
    const CSS_CLASS_ICON_OPTION_NEW = 'fa-file-o';
    const CSS_CLASS_ICON_OPTION_VIEW = 'fa-file-text-o';
    const CSS_CLASS_ICON_OPTION_SEARCH = 'fa-search';
    const CSS_CLASS_ICON_OPTION_REFRESH = 'fa-refresh';
    const CSS_CLASS_ICON_OPTION_FILTER = 'fa-filter';
    const CSS_CLASS_ICON_OPTION_PRINT = 'fa-print';
    const CSS_CLASS_ICON_OPTION_BACK = 'fa-arrow-circle-o-left';
    
    const CSS_CLASS_DISABLE_TOOLBAR = 'iToolbarDisabled';
    
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
