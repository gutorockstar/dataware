<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TecnonView
 *
 * @author augusto
 */
namespace Tecnon\View;

use Zend\View\Helper\AbstractHelper,
    Doctrine\ORM\EntityManager;

class tViewHelper extends AbstractHelper
{
    /**
     * Recebe EntityManager do Doctrine.
     * 
     * @var EntityManegr
     */
    protected $entityManager;
	
    /**
     * Retorna uma Entidade de trabalho para doctrine.
     * 
     * @return EntityManager.
     */
    public function __construct(EntityManager $em) 
    {
        $this->entityManager = $em;      
    }
    
    /**
     * Retorna uma Entidade de trabalho para doctrine.
     * 
     * @return EntityManager.
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
}

?>
