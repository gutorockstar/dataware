<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteBannerHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;

class SiteBannerHelper extends ViewHelper
{
    public function __invoke() 
    {
        $banner = "<div class='banner'>
                       <div id='slider'>
                           <a href='#'><img src='{$this->view->basePath()}/img/site/banner/banner1.jpg' alt='Imagem 1' title='Texto da imagem 1'/></a>
                           <a href='#'><img src='{$this->view->basePath()}/img/site/banner/banner2.jpg' alt='Imagem 2' title='Texto da imagem 2'/></a>
                           <a href='#'><img src='{$this->view->basePath()}/img/site/banner/banner3.jpg' alt='Imagem 3' title='Texto da imagem 3'/></a>
                       </div>
                       <script>$(function() { $('#slider').chocoslider(); });</script>
                   </div>";
        
        return $banner;
    }
}

?>
