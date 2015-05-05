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
                                                <a rel='example_group' href='{$path}' title='Clique para ampliar!'><img class='product-image' alt='' src='{$path}' /></a>
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
