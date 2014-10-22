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
namespace Sysma\View\Helper;

use Sysma\View\Helper\ViewHelper;
use Zend\Session\Container;

class Toolbar extends ViewHelper
{    
    const TB_ACTION_NEW    = 'fa-file-o';
    const TB_ACTION_EDIT   = 'fa-pencil-square-o';
    const TB_ACTION_SEARCH = 'fa-search';
    const TB_ACTION_SAVE   = 'fa-floppy-o';
    const TB_ACTION_DELETE = 'fa-trash-o';
    const TB_ACTION_PRINT  = 'fa-print';
    const TB_ACTION_BACK   = 'fa-arrow-circle-o-left';
    
    /**
     * Carrega a toolbar conforme parâmetros.
     * 
     * @param $disableOptions array
     * @return String html
     */
    public function __invoke($disableOptions = array())
    {
        $userSession = new Container('user');
        $username    = $userSession->username;
        $baseUri     = $this->getBaseUri();
        
        $toolbar = "<nav class='navbar navbar-default'>
                        <div class='toolbar'>";
        
        if ( strlen($username) > 0 )
        {
            $toolbar .= "<div class='tools'>";
            
            $toolbar .= $this->getToolbarOption('add_grid_', self::TB_ACTION_NEW, 'Novo', !in_array(self::TB_ACTION_NEW, $disableOptions));
            $toolbar .= $this->getToolbarOption($baseUri, self::TB_ACTION_EDIT, 'Editar', !in_array(self::TB_ACTION_EDIT, $disableOptions));
            $toolbar .= $this->getToolbarOption($baseUri, self::TB_ACTION_SEARCH, 'Buscar', !in_array(self::TB_ACTION_SEARCH, $disableOptions));
            $toolbar .= $this->getToolbarOption($baseUri, self::TB_ACTION_SAVE, 'Salvar', !in_array(self::TB_ACTION_SAVE, $disableOptions));
            $toolbar .= $this->getToolbarOption($baseUri, self::TB_ACTION_DELETE, 'Excluir', !in_array(self::TB_ACTION_DELETE, $disableOptions));
            $toolbar .= $this->getToolbarOption($baseUri, self::TB_ACTION_PRINT, 'Imprimir', !in_array(self::TB_ACTION_PRINT, $disableOptions));
            $toolbar .= $this->getToolbarOption($baseUri, self::TB_ACTION_BACK, 'Voltar', !in_array(self::TB_ACTION_BACK, $disableOptions));
            
            $toolbar .= "</div>";
        }
        
        return $toolbar . "</div></nav>";
    }
    
    /**
     * Monta e retorna ferramenta da barra de ferramentas.
     * 
     * @param String $baseUri
     * @param String $namespace
     * @param boolean $enable
     * @return String html
     */
    private function getToolbarOption($tbAction, $namespace, $label, $enable = true)
    {
        $class = $enable ? "" : "iToolbarDisabled";
        $href  = $enable ? "href='javascript:void(0)' onClick=\"document.getElementById('{$tbAction}').click()\"" : "";
        
        return "<a {$href} title='{$label}'>
                    <div class='tool'>
                        <i class='fa {$namespace} fa-2x {$class}'></i>
                    </div>
                </a>";
    }
    
    /**
     * Retorna a url base da tela.
     * 
     * @return String
     */
    private function getBaseUri()
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        unset($uri[count($uri) - 1]);
        
        $baseUri = implode('/', $uri);
        
        return $baseUri;
    }
}
