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
        
        if ( is_null($id) || $id == 0 )
        {
            $activeProductsList = $this->getActiveProductsListByCategory($categoryId);

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
        }
        else
        {
            $product = $this->getProduct($id);
            $activeProducts .= $this->view->SiteProductHelper($product);
        }
        
        return $activeProducts . "</div>";
    }
    
    /**
     * Retorna os produtos ativos em destaque.
     * 
     * @return array
     */
    private function getActiveProductsListByCategory($categoryId = null)
    {
        $filters = array(
            'active' => 'TRUE',
        );
        
        if ( is_null($categoryId) || $categoryId == 0 )
        {
            $filters['featured'] = 'TRUE';
        }
        else
        {
            $filters['category'] = $categoryId;
        }
        
        $repository = $this->getEntityManager()->getRepository('Manager\Entity\Product');
        $result = $repository->findBy($filters, array('title' => 'ASC')); 
        
        return $result;
    }
    
    /**
     * Retorna um produto, obtido pelo id.
     * 
     * @param type $productId
     * @return type
     */
    public function getProduct($productId)
    {
        return $this->getEntityManager()->find('Manager\Entity\Product', $productId);
    }
}

?>
