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
                           {$this->view->SiteLogoHelper()}
                           {$this->view->SiteMenuHelper()}
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
