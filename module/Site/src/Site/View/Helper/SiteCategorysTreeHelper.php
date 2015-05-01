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
use System\Model\Panel;

class SiteCategorysTreeHelper extends ViewHelper
{
    public function __invoke($selectedCategoryId = null) 
    {        
        $categorysTree .= "<div class='actions-products'>";

        $formSearch = "<form id='form-search-product' method='post'>
                          <p><input id='search-product' type='text' placeholder='Informe código ou título!'/><br></p>
                          <input id='submit-search-product' type='submit' value='Buscar'/>
                       </form>";
        $panelSearch = new Panel('Buscar produto', $formSearch, 'fa-search');
        $categorysTree .= $this->view->SiteMiniPanelHelper($panelSearch);
                                       
        $treeMenuContent = "";
        $categoriesList = $this->getActiveFatherCategoriesList();
        
        if ( count($categoriesList) > 0 )
        {
            foreach ( $categoriesList as $pos => $category )
            {
                $subitens = array();
                
                foreach ( $this->getActiveSubCategoriesList($category['id']) as $subcategory )
                {
                    $subcategory['href'] = "/products/{$subcategory['id']}";
                    $subitens[] = $subcategory;
                }
                
                $categoriesList[$pos]['subitens'] = $subitens;
            }
            
            $treeMenu = new TreeMenu($categoriesList, $selectedCategoryId);
            $treeMenuContent .= $this->view->TreeMenuHelper($treeMenu);
        }
        
        $panelTreeMenu = new Panel('Categorias', $treeMenuContent, 'fa-folder-open');
        $categorysTree .= $this->view->SiteMiniPanelHelper($panelTreeMenu);
        
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
