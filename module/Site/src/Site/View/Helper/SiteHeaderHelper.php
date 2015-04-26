<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HeaderSiteHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;

class SiteHeaderHelper extends ViewHelper
{
    public function __invoke() 
    {
        $header = "<div class='header'>
                       <div class='header-content'>
                           <div class='logo'>
                               <img src='{$this->view->basePath()}/img/site/logo.png'>
                           </div>

                           <div class='menu'>
                               <nav id='menu'>
                                   <ul>
                                       <li style='background: #333'><a href='#'><i class='fa fa-home'>&nbsp;&nbsp;</i>Principal</a></li>
                                       <li><a href='#'><i class='fa fa-shopping-cart'>&nbsp;&nbsp;</i>Produtos</a></li>
                                       <li><a href='#'><i class='fa fa-history'>&nbsp;&nbsp;</i>Sobre nós</a></li>
                                       <li><a href='#'><i class='fa fa-envelope'>&nbsp;&nbsp;</i>Entre em contato</a></li>
                                   </ul>
                               </nav>
                           </div>
                       </div>
                       <div class='hint'>
                           <div class='text-hint'>
                               QUALIDADE . PRATICIDADE . DURABILIDADE
                           </div>
                       </div>
                   </div>";
        
        return $header;
    }
}

?>
