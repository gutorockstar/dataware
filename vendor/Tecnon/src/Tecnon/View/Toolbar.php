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
namespace Tecnon\View;

use Tecnon\View\ViewHelper;
use Zend\Session\Container;

class Toolbar extends ViewHelper
{    
    const TB_ACTION_NEW    = 'new';
    const TB_ACTION_SAVE   = 'save';
    const TB_ACTION_DELETE = 'delete';
    const TB_ACTION_SEARCH = 'search';
    const TB_ACTION_PRINT  = 'print';
    const TB_ACTION_BACK   = 'back';
    
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
        
        $toolbar = "<div class='toolbar'>";
        
        if ( strlen($username) > 0 )
        {
            $toolbar .= "<div class='tools'>";
            
            $toolbar .= $this->getToolbarOption($baseUri, self::TB_ACTION_NEW, !in_array(self::TB_ACTION_NEW, $disableOptions));
            $toolbar .= $this->getToolbarOption($baseUri, self::TB_ACTION_SAVE, !in_array(self::TB_ACTION_SAVE, $disableOptions));
            $toolbar .= $this->getToolbarOption($baseUri, self::TB_ACTION_DELETE, !in_array(self::TB_ACTION_DELETE, $disableOptions));
            $toolbar .= $this->getToolbarOption($baseUri, self::TB_ACTION_SEARCH, !in_array(self::TB_ACTION_SEARCH, $disableOptions));
            $toolbar .= $this->getToolbarOption($baseUri, self::TB_ACTION_PRINT, !in_array(self::TB_ACTION_PRINT, $disableOptions));
            $toolbar .= $this->getToolbarOption($baseUri, self::TB_ACTION_BACK, !in_array(self::TB_ACTION_BACK, $disableOptions));
            
            $toolbar .= "</div>";
        }
        
        return $toolbar . "</div>";
    }
    
    /**
     * Monta e retorna ferramenta da barra de ferramentas.
     * 
     * @param String $baseUri
     * @param String $namespace
     * @param boolean $enable
     * @return String html
     */
    private function getToolbarOption($baseUri, $namespace, $enable = true)
    {
        $class = $enable ? "img-toolbar" : "img-toolbar-disable";
        $href  = $enable ? "href='{$baseUri}/{$namespace}' class='loading'" : "";
        
        return "<a {$href} title='Novo registro'>
                    <div class='tool'>
                        <img class='{$class}' src='/img/toolbar/{$namespace}.png' />
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
