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

class SiteProductBriefHelper extends ViewHelper
{
    public function __invoke(Product $product)
    {
        $folder = $product->getCover()->getFolder();
        $fileId = $product->getCover()->getId();
        
        $id = $product->getId();
        $value = $product->getValue();
        $title = $product->getTitle();
        $code = $product->getCode();
        $available = $product->getAvailable();
        $description = $product->getDescription();
        
        $productBrief = "<a class='link-produto' title='Clique para visualizar' href='/products/{$id}'>
                             <div class='resumo-produto'>
                                 <div class='capa-produto'>
                                     <img src='{$this->view->basePath($folder . '/' . $fileId)}' width='175' height='150'>
                                 </div>
                                 <div class='titulo-produto'>
                                     {$title}
                                 </div>
                                 <div class='status-produto'>
                                     Código: {$code}<br>
                                     Disponível: " . (((boolean)$available) ? 'SIM' : 'NÃO') . "
                                 </div>
                                 <div class='descricao-produto'>
                                     {$description}
                                 </div>
                             </div>
                         </a>";
        
        return $productBrief;
    }
}

?>
