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
            foreach ( $featuredProductsList as $featuredProduct )
            {
                $featuredProducts .= $this->view->SiteProductBriefHelper($featuredProduct);
            }
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
        $query = $repository->createQueryBuilder('p')
                            ->select("p.id, p.title AS producttitle, p.code, p.description, p.available, f.folder, f.id AS fileid")
                            ->join("p.cover", "f")
                            ->andWhere("p.active = TRUE")
                            ->andWhere("p.featured = TRUE")
                            ->orderBy("p.title")
                            ->getQuery();  
        
        return $query->getResult();
    }
}

?>
