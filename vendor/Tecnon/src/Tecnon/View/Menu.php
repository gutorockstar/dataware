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
                    <div class='collapse navbar-collapse'>";
        
        if ( strlen($username) > 0 )
        {            
            $menu .= "<a href='/admin' title='Home' class='loading'>
                        <div class='home'>
                            <img src='/img/icons/home_menu.png' class='img-home' />
                        </div>
                      </a>
                      {$this->getModules()}";
               
        }
        
        $menu .= "  </div>
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
            "Destaques" => '/featured',
            "Blocos" => '/block',
            "Menu" => '/menu',
            "Interface" => '/interface',
            "Estoque" => '/warehouse',
            "Configurações" => '/settings'
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
                $optionsMenu .= "<li><a class='loading' href='{$action}'>{$name}</a></li>";
            }
        }
        
        $optionsMenu .= "</ul>";
        
        return $optionsMenu;
    }
}

?>
