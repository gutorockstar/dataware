<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CountryController
 *
 * @author augusto
 */
namespace Manager\Controller;

use System\Controller\CrudController;
use Manager\Entity\Category;

class CategoryController extends CrudController
{   
    public function getListValuesToSelectElement($element)
    {
        $entity = $element->getOption('entity');
        
        $repository = $this->getEntityManager()->getRepository($entity);
        $query = $repository->createQueryBuilder('list')
                            ->select("list.id, list.title")
                            ->andWhere("list.categoryfather IS NULL")
                            ->orderBy("list.title")
                            ->getQuery();        
        
        return $query->getResult();
    }
}

?>
