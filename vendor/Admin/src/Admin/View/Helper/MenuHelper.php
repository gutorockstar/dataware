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

namespace Admin\View\Helper;

use Admin\View\Helper\ViewHelper;
use Zend\Session\Container;
use Zend\View\Helper\BasePath;

class MenuHelper extends ViewHelper
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
                            <i class='img-home fa fa-home fa-3x'></i>
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
            "Básico" => array(
                "País" => '/basic/country',
                "Estado" => '/basic/state'
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
