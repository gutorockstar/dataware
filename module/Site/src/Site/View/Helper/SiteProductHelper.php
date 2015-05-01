<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteProductHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;
use Manager\Entity\Product;

class SiteProductHelper extends ViewHelper
{
    public function __invoke(Product $product) 
    {
        $folder = $product->getCover()->getFolder();
        $fileId = $product->getCover()->getId();
        
        $id = $product->getId();
        $categoryId = $product->getCategory()->getId();
        $value = ($product->getValue()) ? "R$ " . $product->getValue() : "(Valor não informado)";
        $title = $product->getTitle();
        $code = $product->getCode();
        $available = $product->getAvailable();
        $description = $product->getDescription();
        
        $productContent = "<div class='product'>
                                <div class='product-cover'>
                                    <div class='productbrief-img'>
                                        <img src='{$this->view->basePath($folder . '/' . $fileId)}' >
                                    </div>
                                    <h4>{$value}</h4>
                                </div>
                                    
    				<div class='product-desc-p'>
                                    <p><b>{$title}</b></p>
                                    Código: {$code}<br>
                                    Disponível: " . (((boolean)$available) ? 'SIM' : 'NÃO') . "<br><br>
                                    Descrição: {$description}
    				</div>
                           </div>";
                                    
        $productContent .= $this->view->SiteProductSliderImagesHelper($product);
        
        return $productContent;
    }
}

?>
