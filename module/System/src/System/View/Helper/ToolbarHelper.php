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
        $userSession = new Container('UserAccount');
        $username = $userSession->username;           
        
        $this->prepareToolbar($toolbar);
        $toolbarActions = $toolbar->getToolbarActions();
        
        $toolbarView = "<nav class='navbar navbar-default'>
                            <div class='toolbar'>
                                <div class='tools'>";
        
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
        if ( $toolbar->getShowDefaultToolbarActions() )
        {
            $toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_NEW, 'Novo', 'add', 'fa-file-o'));
            $toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_EDIT, 'Editar', 'edit', 'fa-edit'));
            $toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_DELETE, 'Excluir', 'delete', 'fa-trash-o'));
            $toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_SEARCH, 'Procurar', 'index', 'fa-search'));
            $toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_UNIFY, 'Unificar', 'unify', 'fa-share-alt fa-rotate-180'));
            $toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_CLONE, 'Clonar', 'clone', 'fa-share-alt'));
            $toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_PRINT, 'Imprimir', 'print', 'fa-print'));
            $toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_BACK, 'Voltar', 'back', 'fa-arrow-circle-o-left'));
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
     * Monta e retorna ferramenta da barra de ferramentas.
     * 
     * @param ToolbarAction $toolbarAction
     * @return String html
     */
    private function createToolbarAction(ToolbarAction $toolbarAction)
    {  
        $currentRouteUrl = $toolbarAction->getEnabled() ? $this->getCurrentRouteUrl() : null;
        
        return "<a id=\"tb_option_{$toolbarAction->getId()}\" title=\"{$toolbarAction->getTitle()}\" href=\"{$currentRouteUrl}{$toolbarAction->getAction()}\">
                    <div class=\"tool\">
                        <i class=\"fa {$toolbarAction->getCssClass()} fa-2x\"></i>
                        <p>{$toolbarAction->getTitle()}</p>
                    </div>
                </a>";
    }
}
