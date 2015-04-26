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
        $menu = "<div class='menu'>
                     <nav id='menu'>
                         <ul>
                             <li style='background: #333'><a href='#'><i class='fa fa-home'>&nbsp;&nbsp;</i>Principal</a></li>
                             <li><a href='#'><i class='fa fa-shopping-cart'>&nbsp;&nbsp;</i>Produtos</a></li>
                             <li><a href='#'><i class='fa fa-history'>&nbsp;&nbsp;</i>Sobre nós</a></li>
                             <li><a href='#'><i class='fa fa-envelope'>&nbsp;&nbsp;</i>Entre em contato</a></li>
                         </ul>
                     </nav>
                 </div>";
        
        return $menu;
    }
}

?>
