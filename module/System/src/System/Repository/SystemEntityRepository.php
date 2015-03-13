<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CrudRepository
 *
 * @author augusto
 */
namespace System\Repository;

use Doctrine\ORM\EntityRepository;

class SystemEntityRepository extends EntityRepository
{
    public function getSelectValues()
    {
        /**
        $querybuilder = $this->_em
                             ->getRepository($this->getEntityName())
                             ->createQueryBuilder('c');
        return $querybuilder->select('c')
                    ->groupBy('c.continent')
                    ->orderBy('c.id', 'ASC')
                    ->getQuery()->getResult();
         * 
         */
        return array('1' => 'Teste 1', '2' => 'Teste 2');
    }
}

?>
