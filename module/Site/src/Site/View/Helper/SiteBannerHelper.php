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
                       <div id='slider'>";
        
        $folder = "uploads/entities/banner/1";
        $filePath = dirname(__DIR__) . "/../../../../../public/" . $folder;
        
        if ( is_dir($filePath) )
        {
            $dir = opendir($filePath);
            
            while ( $read = readdir($dir) ) 
            {
                if ( ( $read != '.' ) && ( $read != '..' ) ) 
                {
                    $path = $this->view->basePath($folder . '/' . $read);
                    $banner .= "<a href='#'><img src='{$path}' alt='Imagem 1' title='Texto da imagem'/></a>";
                }
            }
        }
        
        $banner .= "   </div>
                       <script>$(function() { $('#slider').chocoslider(); });</script>
                   </div>";
        
        return $banner;
    }
}

?>
