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
namespace System\View\Helper;

use System\Model\Toolbar;
use System\Model\ToolbarAction;

use System\View\Helper\ViewHelper;
use Zend\Session\Container;

class ToolbarHelper extends ViewHelper
{   
    /**
     * Carrega a toolbar conforme parâmetros.
     * 
     * @param Toolbar $toolbar
     * @return String html
     */
    public function __invoke(Toolbar $toolbar)
    {
        $userSession = new Container('Login');
        $username = $userSession->username;           
        
        $this->prepareToolbar($toolbar);
        $toolbarActions = $toolbar->getToolbarActions();
        
        $toolbarView = "<nav class='navbar navbar-default'>
                            <div class='toolbar'>
                                <div class='btn-group' role='group'>";
        
        if ( strlen($username) > 0 && count($toolbarActions) > 0 )
        {
            foreach ($toolbarActions as $toolbarAction) 
            {
                $toolbarView .= $this->createToolbarAction($toolbarAction);
            }
        }
        
        return $toolbarView . " </div>
                            </div>
                        </nav>";
    }
    
    /**
     * Retorna a toolbar com todas suas opções, conforme configurações.
     * 
     * @param Toolbar $toolbar
     */
    public function prepareToolbar(Toolbar $toolbar)
    {        
        // Verifica se está habilitado para exibir as ações padrões da barra de ferramentas
        $this->generateDefaultToolbarActions($toolbar);
        
        // Verifica se deve criar novas ações para a barra de ferramentas.
        $this->generateCustomToolbarActions($toolbar);
        
        // Verifica se deve desabilitar alguma ação da barra de ferramentas.
        $this->executeDisableToolbarActions($toolbar);
        
        // Verifica se deve removar alguma ação da barra de ferramentas.
        $this->executeRemoveToolbarActions($toolbar);
    }
    
    /**
     * Popula o objeto Toolbar $this->toolbar, com as ferramentas
     * padrões da barra de ferramentas.
     * 
     * @param Toolbar $toolbar
     */
    private function generateDefaultToolbarActions(Toolbar $toolbar)
    {      
        $id = $this->getCurrentRegisterId();
        $entityName = $this->getCurrentEntityName();
        
        if ( $toolbar->getShowDefaultToolbarActions() )
        {
            $toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_NEW, 'Novo', 'add', 'fa-file'));
            $toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_EDIT, 'Editar', 'edit/' . $id, 'fa-edit'));
            $toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_SAVE, 'Salvar', "void(0)", 'fa-floppy-o', true, "$('#{$entityName}').submit();"));
            //$toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_VIEW, 'Visualizar', 'view', 'fa-eye'));
            $toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_DELETE, 'Excluir', 'delete/' . $id, 'fa-trash'));
            $toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_SEARCH, 'Procurar', 'index', 'fa-search'));
            //$toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_PRINT, 'Imprimir', 'print', 'fa-print'));
            $toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_BACK, 'Voltar', 'back', 'fa-arrow-circle-left'));
        }
    }
    
    /**
     * Gera novas ações customizadas para a barra de ferramentas.
     * 
     * @param Toolbar $toolbar
     */
    private function generateCustomToolbarActions(Toolbar $toolbar)
    {
        $customToolbarActions = $toolbar->getAddCustomToolbarActions();
        
        if ( count($customToolbarActions) > 0 )
        {
            foreach ( $customToolbarActions as $customToolbarAction )
            {
                if ( $customToolbarAction instanceof ToolbarAction)
                {
                    $customToolbarAction->setAction($customToolbarAction->getAction());
                    $toolbar->addToolbarAction($customToolbarAction);
                }
            }
        }
    }
    
    /**
     * Desabilita ações da toolbar, conforme confgurações.
     * 
     * @param Toolbar $toolbar
     */
    private function executeDisableToolbarActions(Toolbar $toolbar)
    {
        $disableToolbarActions = $toolbar->getDisableToolbarActions();
        
        if ( count($disableToolbarActions) > 0 )
        {
            foreach ( $disableToolbarActions as $toolbarAction )
            {
                $toolbar->disableToolbarAction($toolbarAction);
            }
        }
    }
    
    /**
     * Remove ações da toolbar, conforme configurações.
     * 
     * @param Toolbar $toolbar
     */
    private function executeRemoveToolbarActions(Toolbar $toolbar)
    {
        $removeToolbarActions = $toolbar->getRemoveToolbarActions();
        
        if ( count($removeToolbarActions) > 0 )
        {
            foreach ( $removeToolbarActions as $toolbarAction )
            {
                $toolbar->removeToolbarAction($toolbarAction);
            }
        }
    }
    
    /**
     * Obtém a ação atual.
     * 
     * @return string
     */
    private function getCurrentAction()
    {
        $currentUrl = $this->getCurrentUrl();
        $urlExplode = explode("/", $currentUrl);
        $action = is_numeric($urlExplode[count($urlExplode) - 1]) ? $urlExplode[count($urlExplode) - 2] : $urlExplode[count($urlExplode) - 1];
        
        $currentRouteExplode = explode("/", $this->getCurrentViewRoute());
        $currentUrlExplode = explode("/", $this->getCurrentUrl());
        
        if ( $currentRouteExplode[count($currentRouteExplode) - 2] == $currentUrlExplode[count($currentUrlExplode) - 1] )
        {
            $action = 'index';
        }
        
        return $action;
    }
    
    /**
     * Verifica se a ação a ser gerada é a selecionada.
     * 
     * @param type $action
     * @return type
     */
    private function wasSelected($action)
    {
        return ($action == $this->getCurrentAction());
    }
    
    /**
     * Monta e retorna ferramenta da barra de ferramentas.
     * 
     * @param ToolbarAction $toolbarAction
     * @return String html
     */
    private function createToolbarAction(ToolbarAction $toolbarAction)
    {  
        $currentRouteUrl = $toolbarAction->getEnabled() ? $this->getCurrentRouteUrl() : null;
        $disableStyleClass = $toolbarAction->getEnabled() ? "" : "disabled-style";
        $loading = $toolbarAction->getEnabled() ? "loading" : "";
        $toolSelectedClass = $this->wasSelected($toolbarAction->getAction()) ? "tool-selected" : "";
        $href = is_null($toolbarAction->getOnClick()) ? $currentRouteUrl . $toolbarAction->getAction() : "javascript:void(0)";
        
        return "<button type='button' class=\"btn btn-default {$toolSelectedClass}\">
                    <a class='{$loading}' id=\"tb_option_{$toolbarAction->getId()}\" title=\"{$toolbarAction->getTitle()}\" href=\"{$href}\" onClick=\"{$toolbarAction->getOnClick()}\">
                        <i class=\"fa {$toolbarAction->getCssClass()} fa-2x {$toolSelectedClass}\"></i>
                        <p class=\"title-tool {$disableStyleClass} {$toolSelectedClass}\">{$toolbarAction->getTitle()}</p>
                    </a>
                </button>";
    }
}
