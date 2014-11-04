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
namespace Innerbridge\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Doctrine\ORM\EntityManager;

class ViewHelper extends AbstractHelper
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
    
    /**
     * Cria nova view recebendo o conteúdo por parâmetro
     * 
     * @param String html $insideElements
     */
    public function __invoke($header = null, $viewContent = array(), $styles = array())
    {
        if ( count($styles) > 0 )
        {
            foreach ( $styles as $attribute => $value )
            {
                $style .= "{$attribute}:$value;";
            }
        }
        
        $view = "<fieldset style='{$style}'>
                     <legend>{$header}</legend>";
        
        if ( count($viewContent) > 0 )
        {
            foreach ( $viewContent as $content )
            {
                $view .= $content;
            }
        }
        else
        {
            $view .= "<p>Nenhum conteúdo encontrado...</p>";
        }
                    
        $view .= "</fieldset>";
        
        return $view;
    }
}

?>
