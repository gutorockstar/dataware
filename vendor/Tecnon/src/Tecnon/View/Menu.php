<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TecnonMenuView
 *
 * @author augusto
 */

namespace Tecnon\View;

use Tecnon\View\ViewHelper;
use Zend\Session\Container;
use Zend\View\Helper\BasePath;

class Menu extends ViewHelper
{    
    public function __invoke()
    {        
        $userSession = new Container('user');
        $username    = $userSession->username;
        
        $menu = "<div class='container'>
                    <div class='navbar-header'>
                        <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                        </button>
                        <a class='navbar-brand' href='/admin'><img src='/img/simple_logo_mini.png' alt='Zend Framework 2'/>&nbsp;Tecnon Manager</a>
                    </div>
                    <div class='collapse navbar-collapse'>";
        
        if ( strlen($username) > 0 )
        {            
            $menu .= $this->getModules();
               
        }
        
        $menu .= "</div>
              </div>";
        
        return $menu;
    }
    
    /**
     * Retorna os módulos para popular o menu conforme permições do usuário.
     * 
     * @return string html
     */
    private function getModules()
    {
        $modulesArray = array(
            "Artigos" => array(
                "Categorias e subcategorias" => '/category',
                "Artigos" => '/article'
            ),
            "Estoque" => '/warehouse',
            "Destaque" => '/featured',
            "Blocos" => '/block',
            "Menu" => '/menu',
            "Interface" => '/interface'
        );
        
        return $this->getOptionsMenu($modulesArray);
    }
    
    /**
     * Monta as opções do menu.
     * 
     * @param type $options
     * @return type
     */
    public function getOptionsMenu($options, $dropDown = false)
    {
        $ulClass = $dropDown ? 'dropdown-menu' : 'nav navbar-nav';
        $optionsMenu .= "<ul class='{$ulClass}'>";
        
        foreach ( $options as $name => $action )
        {
            if ( is_array($action) )
            {
                $optionsMenu .= "<li class='dropdown'>
                                    <a href='' class='dropdown-toggle' data-toggle='dropdown'>{$name}<b class='caret'></b></a>";
                $optionsMenu .= $this->getOptionsMenu($action, true);
                $optionsMenu .= "</li>";
            }
            else
            {
                $optionsMenu .= "<li><a href='{$action}'>{$name}</a></li>";
            }
        }
        
        $optionsMenu .= "</ul>";
        
        return $optionsMenu;
    }
}

?>