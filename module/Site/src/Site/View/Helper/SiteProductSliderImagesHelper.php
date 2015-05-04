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
        $this->view->headScript()->prependFile($this->view->basePath() . '/jqueryFancyBox/fancybox/image-gallery.js');
        $this->view->headScript()->prependFile($this->view->basePath() . '/jqueryFancyBox/fancybox/jquery.fancybox-1.3.4.pack.js');
        $this->view->headScript()->prependFile($this->view->basePath() . '/jqueryFancyBox/fancybox/jquery.mousewheel-3.0.4.pack.js');
        $this->view->headScript()->prependFile($this->view->basePath() . '/jqueryFancyBox/jquery-1.4.3.min.js');
       
        // ESTÁ FUDENDO O TREE VIEW, POR CONFLITO DE JQUERY!!!!!!!!!
        
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
