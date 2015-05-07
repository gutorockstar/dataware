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
        
        $productSliderImages .= $this->view->headScript()->prependFile($this->view->basePath() . '/jssorSlider/js/image-gallery.js');

        $productSliderImages = "<!-- Jssor Slider Begin -->
        <!-- To move inline styles to css file/block, please specify a class name for each element. --> 
        <div id='slider1_container' style='position: relative; top: 0px; left: 0px; width: 100%; height: 350px; margin-left: 15px; background: #191919; overflow: hidden;'>

            <!-- Loading Screen -->
            <div u='loading' style='position: absolute; top: 0px; left: 0px;'>
                <div style='filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                    background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;'>
                </div>
                <div style='position: absolute; display: block; background: url({$this->view->basePath('jssorSlider/img/loading.gif')}) no-repeat center center;
                    top: 0px; left: 0px;width: 100%;height:100%;'>
                </div>
            </div>

            <!-- Slides Container -->
            <div u='slides' style='cursor: move; position: absolute; left: 240px; top: 0px; width: 405px; height: 350px; overflow: hidden;'>";
                
                
                
                
        
        
        $folder = "uploads/entities/" . $attachment->getEntityName() . '/' . $attachment->getEntityId();
        $filePath = dirname(__DIR__) . "/../../../../../public/" . $folder;
        
        if ( is_dir($filePath) )
        {
            /**
            $productSliderImages .= "<div id='content' class='product-images'>
                                         <p>";
             * 
             */
            
            $dir = opendir($filePath);
            
            while ( $read = readdir($dir) ) 
            {
                if ( ( $read != '.' ) && ( $read != '..' ) ) 
                {
                    $path = $this->view->basePath($folder . '/' . $read);
                    $productSliderImages .= "
                                             <div>
                                                <img u='image' src='{$path}' width='405' height='350' />
                                                
                                                <a href='{$path}' class='highslide' onclick='return hs.expand(this)' title='Clique para visualizar'>
                                                    <img u='thumb'  src='{$path}' alt='Highslide JS' class='product-image' />
                                                </a>
                                            </div>
                                            
                                             <!--<div>
                                                <a href='{$path}' class='highslide' onclick='return hs.expand(this)' title='Clique para visualizar'>
                                                    <img src='{$path}' alt='Highslide JS' class='product-image'/>
                                                </a>
                                             </div>-->";
                }       
            }
            
            /**
            $productSliderImages .= "    </p>
                                     </div>";
             * 
             */
        }
        
        
        $productSliderImages .= "</div>

            <!--#region Arrow Navigator Skin Begin -->
            <style>
                /* jssor slider arrow navigator skin 05 css */
                /*
                .jssora05l                  (normal)
                .jssora05r                  (normal)
                .jssora05l:hover            (normal mouseover)
                .jssora05r:hover            (normal mouseover)
                .jssora05l.jssora05ldn      (mousedown)
                .jssora05r.jssora05rdn      (mousedown)
                */
                .jssora05l, .jssora05r {
                    display: block;
                    position: absolute;
                    /* size of arrow element */
                    width: 40px;
                    height: 40px;
                    cursor: pointer;
                    background: url({$this->view->basePath('jssorSlider/img/a17.png')}) no-repeat;
                    overflow: hidden;
                }
                .jssora05l { background-position: -10px -40px; }
                .jssora05r { background-position: -70px -40px; }
                .jssora05l:hover { background-position: -130px -40px; }
                .jssora05r:hover { background-position: -190px -40px; }
                .jssora05l.jssora05ldn { background-position: -250px -40px; }
                .jssora05r.jssora05rdn { background-position: -310px -40px; }
            </style>
            <!-- Arrow Left -->
            <span u='arrowleft' class='jssora05l' style='top: 158px; left: 248px;'>
            </span>
            <!-- Arrow Right -->
            <span u='arrowright' class='jssora05r' style='top: 158px; right: 8px'>
            </span>
            <!--#endregion Arrow Navigator Skin End -->
            <!--#region Thumbnail Navigator Skin Begin -->
            <!-- Help: http://www.jssor.com/development/slider-with-thumbnail-navigator-jquery.html -->
            <style>
                /* jssor slider thumbnail navigator skin 02 css */
                /*
                .jssort02 .p            (normal)
                .jssort02 .p:hover      (normal mouseover)
                .jssort02 .p.pav        (active)
                .jssort02 .p.pdn        (mousedown)
                */

                .jssort02 {
                    position: absolute;
                    /* size of thumbnail navigator container */
                    width: 240px;
                    height: 350px;
                }

                    .jssort02 .p {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 99px;
                        height: 66px;
                    }

                    .jssort02 .t {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        border: none;
                    }

                    .jssort02 .w {
                        position: absolute;
                        top: 0px;
                        left: 0px;
                        width: 100%;
                        height: 100%;
                    }

                    .jssort02 .c {
                        position: absolute;
                        top: 0px;
                        left: 0px;
                        width: 95px;
                        height: 62px;
                        border: #000 2px solid;
                        box-sizing: content-box;
                        background: url({$this->view->basePath('jssorSlider/img/t01.png')}) -800px -800px no-repeat;
                        _background: none;
                    }

                    .jssort02 .pav .c {
                        top: 2px;
                        _top: 0px;
                        left: 2px;
                        _left: 0px;
                        width: 95px;
                        height: 62px;
                        border: #000 0px solid;
                        _border: #fff 2px solid;
                        background-position: 50% 50%;
                    }

                    .jssort02 .p:hover .c {
                        top: 0px;
                        left: 0px;
                        width: 97px;
                        height: 64px;
                        border: #fff 1px solid;
                        background-position: 50% 50%;
                    }

                    .jssort02 .p.pdn .c {
                        background-position: 50% 50%;
                        width: 95px;
                        height: 62px;
                        border: #000 2px solid;
                    }

                    * html .jssort02 .c, * html .jssort02 .pdn .c, * html .jssort02 .pav .c {
                        /* ie quirks mode adjust */
                        width /**/: 99px;
                        height /**/: 66px;
                    }
            </style>

            <!-- thumbnail navigator container -->
            <div u='thumbnavigator' class='jssort02' style='left: 0px; bottom: 0px;'>
                <!-- Thumbnail Item Skin Begin -->
                <div u='slides' style='cursor: default;'>
                    <div u='prototype' class='p'>
                        <div class=w><div u='thumbnailtemplate' class='t'></div></div>
                        <div class=c></div>
                    </div>
                </div>
                <!-- Thumbnail Item Skin End -->
            </div>
            <!--#endregion Thumbnail Navigator Skin End -->
            <a style='display: none' href='http://www.jssor.com'>Slider Javascript</a>
        </div>";
        
        return $productSliderImages;
    }
}

?>
