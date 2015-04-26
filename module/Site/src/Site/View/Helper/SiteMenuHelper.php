<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteHeaderMenuHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;

class SiteMenuHelper extends ViewHelper
{
    public function __invoke() 
    {
        $currentRoute = $this->getCurrentRoute();
        $menuRoutes = array(
            'home' => array(
                'action' => '/',
                'caption' => 'Principal'
            ),
            'products' => array(
                'action' => '/products',
                'caption' => 'Produtos'
            ),
            'aboutus' => array(
                'action' => '/aboutus',
                'caption' => 'Sobre nós'
            ),
            'contact' => array(
                'action' => '/contact',
                'caption' => 'Entre em contato'
            )
        );
        
        $menu = "<div class='menu'>
                     <nav id='menu'>
                         <ul>";
        
        foreach ( $menuRoutes as $route => $menuData )
        {
            $menuSelected = ($route == $currentRoute) ? "menu-selected" : "";
            
            $menu .= "       <li class='{$menuSelected}'>
                                 <a href='{$menuData['action']}'>
                                     <i class='fa fa-shopping-cart loading'>&nbsp;&nbsp;</i>
                                     {$menuData['caption']}
                                 </a>
                             </li>";
        }
        
        $menu .= "       </ul>
                     </nav>
                 </div>";
        
        return $menu;
    }
}

?>
