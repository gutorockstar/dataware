<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Toolbar
 *
 * @author augusto
 */
namespace Admin\View\Helper;

use Admin\Entity\Toolbar;
use Admin\Entity\ToolbarOption;
use Admin\Controller\ToolbarController;

use Admin\View\Helper\ViewHelper;
use Zend\Session\Container;

class ToolbarHelper extends ViewHelper
{   
    /**
     * Carrega a toolbar conforme parâmetros.
     * 
     * @return String html
     */
    public function __invoke()
    {
        $userSession = new Container('user');
        $username = $userSession->username;
        
        $toolbarController = new ToolbarController();
        $toolbarOptions = $toolbarController->getToolbar()->getToolbarOptions();
        
        $toolbarView = "<nav class='navbar navbar-default'>
                            <div class='toolbar'>
                                <div class='tools'>";
        
        //if ( strlen($username) > 0 && count($toolbarOptions) > 0 )
        if ( strlen($username) > 0 )
        {
            $toolbarView .= $this->createToolbarOption(array('id' => 1, 'title' => 'Novo', 'action' => 'add', 'fontAwesomeCssClass' => 'fa-file-o'));
            $toolbarView .= $this->createToolbarOption(array('id' => 2, 'title' => 'Editar', 'action' => 'edit', 'fontAwesomeCssClass' => 'fa-edit'));
            $toolbarView .= $this->createToolbarOption(array('id' => 3, 'title' => 'Excluir', 'action' => 'delete', 'fontAwesomeCssClass' => 'fa-trash-o'));
            $toolbarView .= $this->createToolbarOption(array('id' => 4, 'title' => 'Procurar', 'action' => 'index', 'fontAwesomeCssClass' => 'fa-search'));
            $toolbarView .= $this->createToolbarOption(array('id' => 5, 'title' => 'Unificar', 'action' => 'unify', 'fontAwesomeCssClass' => 'fa-share-alt fa-rotate-180'));
            $toolbarView .= $this->createToolbarOption(array('id' => 6, 'title' => 'Duplicar', 'action' => 'duplicate', 'fontAwesomeCssClass' => 'fa-share-alt'));
            $toolbarView .= $this->createToolbarOption(array('id' => 7, 'title' => 'Imprimir', 'action' => 'print', 'fontAwesomeCssClass' => 'fa-print'));
            $toolbarView .= $this->createToolbarOption(array('id' => 8, 'title' => 'Voltar', 'action' => 'back', 'fontAwesomeCssClass' => 'fa-arrow-circle-o-left'));
        }
        
        return $toolbarView . " </div>
                            </div>
                        </nav>";
    }
    
    /**
     * Monta e retorna ferramenta da barra de ferramentas.
     * 
     * @param int $id
     * @param String $title
     * @param String $action
     * @param String $cssIconClass
     * @param boolean $enabled
     * @param String $method
     * @return String html
     */
    private function createToolbarOption(array $toolbarOption)
    {                
        return "<a id=\"tb_option_{$toolbarOption['id']}\" title=\"{$toolbarOption['title']}\" href=\"{$toolbarOption['action']}\">
                    <div class=\"tool\">
                        <i class=\"fa {$toolbarOption['fontAwesomeCssClass']} fa-2x\"></i>
                    </div>
                </a>";
    }
}
