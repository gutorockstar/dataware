<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteProductBriefHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;
use Manager\Entity\Product;
use System\Entity\File;

class SiteProductBriefHelper extends ViewHelper
{
    public function __invoke(Product $product)
    {
        $applicationConfig = $this->getView()->getHelperPluginManager()->getServiceLocator()->get('config');
        $path = $this->view->basePath($applicationConfig['no_image_path']);
            
        if ( $product->getCover() instanceof File )
        {
            $folder = $product->getCover()->getFolder();
            $fileId = $product->getCover()->getId();
            
            $path = $this->view->basePath($folder . '/' . $fileId);
        }
        
        $id = $product->getId();
        $categoryId = $product->getCategory()->getId();
        $value = ($product->getValue()) ? "R$ " . $product->getValue() : "(Valor não informado)";
        $title = $product->getTitle();
        $code = $product->getCode();
        $available = $product->getAvailable();
        
        $productBrief = "<div class='productbrief'>
                            <a class='linkProductbrief' title='Clique para visualizar' href='/products/{$categoryId}/{$id}'>
    				<div class='productbrief-img'>
                                    <img src='{$path}' >
                                </div>
                                <h4>{$value}</h4>
    				<div class='productbrief-desc-p'>
                                    <p><b>{$title}</b></p>
                                    Código: {$code}<br>
                                    Disponível: " . (((boolean)$available) ? 'SIM' : 'NÃO') . "
    				</div>
    				<div class='box-item box-item1'>
    				</div>
                            </a>
  			 </div>";
        
        return $productBrief;
    }
}

?>
