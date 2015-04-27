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

class SiteProductBriefHelper extends ViewHelper
{
    public function __invoke(Array $productBriefData)
    {
        $productBrief = "<a class='link-produto' title='Clique para visualizar' href='/products/{$productBriefData['id']}'>
                             <div class='resumo-produto'>
                                 <div class='capa-produto'>
                                     <img src='{$this->view->basePath($productBriefData['folder'] . '/' . $productBriefData['fileid'])}' width='175' height='150'>
                                 </div>
                                 <div class='titulo-produto'>
                                     {$productBriefData['producttitle']}
                                 </div>
                                 <div class='status-produto'>
                                     Código: {$productBriefData['code']}<br>
                                     Disponível: " . (((boolean)$productBriefData['available']) ? 'SIM' : 'NÃO') . "
                                 </div>
                                 <div class='descricao-produto'>
                                     {$productBriefData['description']}
                                 </div>
                             </div>
                         </a>";
        
        return $productBrief;
    }
}

?>
