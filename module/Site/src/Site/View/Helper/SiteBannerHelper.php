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
        $errorMessage = $this->view->SimpleAlertHelper(new \System\Model\Alert("Desculpe, no momento não temos banners comerciais para exibição! :("));
        $banner = "<div class='banner'>
                       <div id='slider'>";
        
        $folder = "uploads/entities/banner/1";
        $filePath = dirname(__DIR__) . "/../../../../../public/" . $folder;
        $imgsBanner = "";
        
        if ( is_dir($filePath) )
        {
            $dir = opendir($filePath);
            
            while ( $read = readdir($dir) ) 
            {
                if ( ( $read != '.' ) && ( $read != '..' ) ) 
                {
                    $path = $this->view->basePath($folder . '/' . $read);
                    $imgsBanner .= "<a href='#'><img src='{$path}' alt='Imagem 1' title='Texto da imagem'/></a>";
                }
            }
        }
        
        $banner .= "   {$imgsBanner}
                       </div>
                       <script>$(function() { $('#slider').chocoslider(); });</script>
                   </div>";
        
        return (strlen($imgsBanner) > 0) ? $banner : $errorMessage;
    }
}

?>
