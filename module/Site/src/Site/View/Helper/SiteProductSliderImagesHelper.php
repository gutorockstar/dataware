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
        $this->view->headScript()->prependFile($this->view->basePath() . '/jssorSlider/js/image-gallery.js');

        $productSliderImages .= "<div id='slider1_container' style='position: relative; top: 0px; left: 0px; width: 650px; height: 350px; margin-left: 15px; background: #191919; overflow: hidden;'>
            
                                     <div u='loading' style='position: absolute; top: 0px; left: 0px;'>
                                         <div style='filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block; background-color: #000000; top: 0px; left: 0px;width: 650px;height:100%;'>
                                         </div>
                                         <div style='position: absolute; display: block; background: url({$this->view->basePath('jssorSlider/img/loading.gif')}) no-repeat center center; top: 0px; left: 0px;width: 100%;height:100%;'>
                                         </div>
                                     </div>
                                     
                                     <div u='slides' style='cursor: move; position: absolute; left: 240px; top: 0px; width: 400px; height: 350px; overflow: hidden;'>";       
        
        
        $folder = "uploads/entities/" . $attachment->getEntityName() . '/' . $attachment->getEntityId();
        $filePath = dirname(__DIR__) . "/../../../../../public/" . $folder;
        
        if ( is_dir($filePath) )
        {            
            $dir = opendir($filePath);
            
            while ( $read = readdir($dir) ) 
            {
                if ( ( $read != '.' ) && ( $read != '..' ) ) 
                {
                    $path = $this->view->basePath($folder . '/' . $read);
                    $productSliderImages .= "<div>
                                                 <img u='image' src='{$path}' width='400' height='350' />
                                                 <a href='{$path}' class='highslide' onclick='return hs.expand(this)' title='Clique para visualizar'>
                                                     <img u='thumb'  src='{$path}' alt='Highslide JS' class='product-image' />
                                                 </a>
                                             </div>";
                }       
            }
        }
        
        
        $productSliderImages .= "    </div>
            
                                     <span u='arrowleft' class='jssora05l' style='top: 158px; left: 248px;'></span>
                                     <span u='arrowright' class='jssora05r' style='top: 158px; right: 25px'></span>

                                     <div u='thumbnavigator' class='jssort02' style='left: 0px; bottom: 0px;'>
                                         <div u='slides' style='cursor: default;'>
                                             <div u='prototype' class='p'>
                                                 <div class=w>
                                                     <div u='thumbnailtemplate' class='t'>
                                                     </div>
                                                 </div>
                                                 <div class='c'></div>
                                             </div>
                                         </div>   
                                     </div>
                                     
                                 </div>";
        
        return $productSliderImages;
    }
}

?>
