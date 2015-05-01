<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Manager\Controller;

use System\Controller\CrudController;

class ProductController extends CrudController
{ 
    public function addAction() 
    {
        if ( $this->validateMaxFeaturedProducts() )
        {
            return parent::addAction();
        }
    }
    
    public function editAction() 
    {
        if ( $this->validateMaxFeaturedProducts() )
        {
            return parent::editAction();
        }
    }
    
    /**
     * Valida se o produto pode ser registrado como destaque.
     * caso tenha exedido a quantidade máxima de destaques,
     * não permite o registro, acusando erro.
     * 
     * @return boolean
     */
    private function validateMaxFeaturedProducts()
    {
        $return = true;
        $request = $this->getRequest();
        
        if ( $request->isPost() )
        {
            $applicationConfig = $this->getServiceLocator()->get('config');
            $postData = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            
            // Se o produto foi marcado para ser um destaque, e já excedeu o máximo de destaques registrados conforme configuração.
            if ( (boolean)$postData['featured'] && ($this->getFeaturedProductsCount() == $applicationConfig['max_featured_products']) )
            {
                $this->flashMessenger()->addErrorMessage("A quantidade máxima de produtos em destaque já foi excedida! Para colocar este produto em destaque, será necessário desmarcar algum outro produto que esteja em destaque.");
                $this->redirect()->toRoute($this->getCurrentRoute(), array('action' => $this->getCurrentAction()), array('query' => $postData));
                $return = false;
            }
        }
        
        return $return;
    }
    
    /**
     * Retorna a quantidade de produtos em destaque cadastrados.
     * 
     * @return type
     */
    private function getFeaturedProductsCount()
    {
        $repository = $this->getEntityManager()->getRepository('Manager\Entity\Product');
        $query = $repository->createQueryBuilder('p')
                            ->select("COUNT(p.id)")
                            ->andWhere("p.featured = TRUE")
                            ->getQuery();
        
        $result = $query->getResult();
        
        return $result[0][1];
    }
    
    /**
     * Sobrescrita da listagem de categorias
     * 
     * @param type $element
     * @return type
     */
    public function getListValuesToSelectElement($element)
    {
        $entity = $element->getOption('entity');
        
        if ( $entity == 'Manager\Entity\Category' )
        {
            $repository = $this->getEntityManager()->getRepository($entity);
            $query = $repository->createQueryBuilder('list')
                                ->select("list.id, list.title")
                                ->andWhere("list.categoryfather IS NOT NULL")
                                ->orderBy("list.title")
                                ->getQuery();        

            return $query->getResult();
        }
        
        return parent::getListValuesToSelectElement($element);
    }
}
