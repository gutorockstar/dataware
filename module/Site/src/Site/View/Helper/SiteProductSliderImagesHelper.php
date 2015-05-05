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
        
        if ( is_dir($filePath) )
        {
            $productSliderImages .= "<div id='content' class='product-images'>
                                         <p>";
            
            $dir = opendir($filePath);
            
            while ( $read = readdir($dir) ) 
            {
                if ( ( $read != '.' ) && ( $read != '..' ) ) 
                {
                    $path = $this->view->basePath($folder . '/' . $read);
                    $productSliderImages .= "<div>
                                                <a href='{$path}' class='highslide' onclick='return hs.expand(this)' title='Clique para visualizar'>
                                                    <img src='{$path}' alt='Highslide JS' class='product-image'/>
                                                </a>
                                             </div>";
                }       
            }
            
            $productSliderImages .= "    </p>
                                     </div>";
        }
        
        return $productSliderImages;
    }
}

?>
