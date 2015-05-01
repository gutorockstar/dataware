<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteCategorysTree
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;
use System\Model\TreeMenu;

class SiteCategorysTreeHelper extends ViewHelper
{
    public function __invoke() 
    {
        $categorysTree = "<div class='categorystree'>";
        $categoriesList = $this->getActiveFatherCategoriesList();
        
        if ( count($categoriesList) > 0 )
        {
            foreach ( $categoriesList as $pos => $category )
            {
                $categoriesList[$pos]['subitens'] = $this->getActiveSubCategoriesList($category['id']);
            }
            
            $treeMenu = new TreeMenu($categoriesList);
            $categorysTree .= $this->view->TreeMenuHelper($treeMenu);
        }
        
        return $categorysTree . "</div>";
    }
    
    /**
     * Retorna as categorias pais, ativas.
     * 
     * @return array
     */
    private function getActiveFatherCategoriesList()
    {
        $repository = $this->getEntityManager()->getRepository('Manager\Entity\Category');
        $query = $repository->createQueryBuilder('c')
                            ->select("c.id, c.title")
                            ->andWhere("c.active = TRUE")
                            ->andWhere("c.categoryfather IS NULL")
                            ->orderBy('c.title')
                            ->getQuery();
        
        $result = $query->getResult();
        
        return $result;
    }
    
    /**
     * Retorna as categorias filhos, ativas.
     * 
     * @param int $categoryFatherId
     * @return array
     */
    private function getActiveSubCategoriesList($categoryFatherId)
    {
        $repository = $this->getEntityManager()->getRepository('Manager\Entity\Category');
        $query = $repository->createQueryBuilder('c')
                            ->select("c.id, c.title")
                            ->andWhere("c.active = TRUE")
                            ->andWhere("c.categoryfather = {$categoryFatherId}")
                            ->orderBy('c.title')
                            ->getQuery();
        
        $result = $query->getResult();
        
        return $result;
    }
}

?>
