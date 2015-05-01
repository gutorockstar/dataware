<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteActiveProductsHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;

class SiteActiveProductsHelper extends ViewHelper
{
    public function __invoke($id = null, $categoryId = null) 
    {
        $activeProducts = "<div class='active-products'>";
     
        $activeProductsList = $this->getActiveProductsListByCategory();
        
        if ( count($activeProductsList) > 0 )
        {
            foreach ( $activeProductsList as $product )
            {
                $activeProducts .= $this->view->SiteProductBriefHelper($product);
            }
        }
        else
        {
            $activeProducts .= $this->view->SimpleAlertHelper(new \System\Model\Alert("Desculpe, no momento não temos produtos ativos! :("));
        }
        
        return $activeProducts . "</div>";
    }
    
    /**
     * Retorna os produtos ativos em destaque.
     * 
     * @return array
     */
    private function getActiveProductsListByCategory()
    {
        $repository = $this->getEntityManager()->getRepository('Manager\Entity\Product');
        $result = $repository->findBy(array('active' => 'TRUE', 'featured' => 'TRUE'), array('title' => 'ASC')); 
        
        return $result;
    }
}

?>
