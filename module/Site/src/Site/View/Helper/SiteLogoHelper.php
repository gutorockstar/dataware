<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteHeaderLogoHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;

class SiteLogoHelper extends ViewHelper
{
    public function __invoke() 
    {
        $logo = "<div class='logo'>
                     <img src='{$this->view->basePath()}/img/site/logo.png'>
                 </div>";
                     
        return $logo;
    }
}

?>
