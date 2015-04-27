<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteFooterHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;

class SiteFooterHelper extends ViewHelper
{
    public function __invoke() 
    {
        $footer = "<div class='footer'>
                       <div class='footer-content'>
                       
                       </div>
                   </div>";
        
        return $footer;
    }
}

?>
