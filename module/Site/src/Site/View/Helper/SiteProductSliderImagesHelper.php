<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteProductSliderImagesHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;
use System\Model\Attachment;

class SiteProductSliderImagesHelper extends ViewHelper
{
    public function __invoke(Attachment $attachment) 
    {                
        $folder = "uploads/entities/" . $attachment->getEntityName() . '/' . $attachment->getEntityId();
        $filePath = dirname(__DIR__) . "/../../../../../public/" . $folder;
        
        $productSliderImages = "";
        
        if ( is_dir($filePath) )
        {
            $productSliderImages .= "<div id='slider1_container' style='position: relative; top: 0px; left: 0px; width: 100%; height: 350px; margin-left: 15px; background: #191919; overflow: hidden;'>";
            
            $dir = opendir($filePath);
            
            while ( $read = readdir($dir) ) 
            {
                if ( ( $read != '.' ) && ( $read != '..' ) ) 
                {
                    $path = $this->view->basePath($folder . '/' . $read);
                    $productSliderImages .= "<div>
                                                 <img u='image' src='{$path}' width='405' height='350' />
                                             </div>";
                }       
            }
            
            $productSliderImages .= "</div>";
        }
        
        return $productSliderImages;
    }
}

?>
