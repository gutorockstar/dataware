<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteFeaturedProductsHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;

class SiteFeaturedProductsHelper extends ViewHelper
{
    public function __invoke() 
    {
        $featuredProducts = "<div class='destaques'>
                                 <div class='produtos-destaque'>";
     
        $featuredProductsList = $this->getFeaturedProductsList();
        
        if ( count($featuredProductsList) > 0 )
        {
            foreach ( $featuredProductsList as $product )
            {
                $featuredProducts .= $this->view->SiteProductBriefHelper($product);
            }
        }
        else
        {
            $featuredProducts .= $this->view->SimpleAlertHelper(new \System\Model\Alert("Desculpe, no momento não temos produtos em destaque! :("));
        }
        
        $featuredProducts .= "   </div>
                             </div>

                             <nav id='menu' >
                                 <ul>
                                     <li class='see-more'>
                                         <a href='/products'>
                                             Veja mais de nossos produtos&nbsp;&nbsp;
                                             <i class='fa fa-arrow-circle-o-right fa-lg'></i>
                                         </a>
                                     </li>
                                 </ul>
                             </nav>";
        
        return $featuredProducts;
    }
    
    /**
     * Retorna os produtos ativos em destaque.
     * 
     * @return array
     */
    private function getFeaturedProductsList()
    {
        $repository = $this->getEntityManager()->getRepository('Manager\Entity\Product');
        $result = $repository->findBy(array('active' => 'TRUE', 'featured' => 'TRUE'), array('title' => 'DESC')); 
        
        return $result;
    }
}

?>
