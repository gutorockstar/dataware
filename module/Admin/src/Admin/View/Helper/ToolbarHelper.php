<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Toolbar
 * $tbOptions ex.: 
       array(
            'showDefaultToolbarActions' => true,
            'addCustomToolbarActions' => array(
                new \Admin\Entity\ToolbarAction('tb_option_refresh', 'Atualizar', 'refresh', 'fa-refresh'),
                new \Admin\Entity\ToolbarAction('tb_option_config', 'Configurações', 'config', 'fa-cog', false)
            ),
            'disableToolbarActions' => array(
                Admin\Entity\Toolbar::TB_ACTION_PRINT,
            ),
            'removeToolbarActions' => array(
                \Admin\Entity\Toolbar::TB_ACTION_UNIFY,
                \Admin\Entity\Toolbar::TB_ACTION_CLONE
            )
       )
 *
 * @author augusto
 */
namespace Admin\View\Helper;

use Admin\Entity\Toolbar;
use Admin\Entity\ToolbarAction;
use Admin\Controller\ToolbarController;

use Admin\View\Helper\ViewHelper;
use Zend\Session\Container;

class ToolbarHelper extends ViewHelper
{   
    /**
     * Carrega a toolbar conforme parâmetros.
     * 
     * @param array $tbOptions
     * @return String html
     */
    public function __invoke($tbOptions = array())
    {
        $userSession = new Container('UserAccount');
        $username = $userSession->username;           
        
        $toolbarController = new ToolbarController($tbOptions);
        $toolbarActions = $toolbarController->getToolbar()->getToolbarActions();
        
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
                    </div>
                </a>";
    }
}
