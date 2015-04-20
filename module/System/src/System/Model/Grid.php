<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Grid
 *
 * @author augusto
 */
namespace System\Model;

use System\Model\GridColumn;

class Grid 
{
    /**
     * @var ObjClass
     */
    private $entity;
    
    /**
     * @var array
     */
    private $columns = array();
    
    /**
     *
     * @var ArrayObject
     */
    private $data;
    
    /**
     * 
     * @var type 
     */
    private $hasEntity = true;
    
    /**
     *
     * @var type 
     */
    private $generateFieldset = true;
    
    /**
     *
     * @var String
     */
    private $gridActions = array();
    
    public function __construct($data = null) 
    {
        if ( !is_null($data) )
        {
            $this->data = $data;
        }
    }
    
    public function addColumn(GridColumn $gridColumn)
    {
        $this->columns[] = $gridColumn;
    }
    
    public function getEntity() 
    {
        return $this->entity;
    }

    public function setEntity($entity) 
    {
        $this->entity = $entity;
    }
        
    public function getColumns() 
    {
        return $this->columns;
    }

    public function setColumns($columns) 
    {
        $this->columns = $columns;
    }
        
    public function getData() 
    {
        return $this->data;
    }

    public function setData($data) 
    {
        $this->data = $data;
    }
    
    public function hasEntity() 
    {
        return $this->hasEntity;
    }

    public function setHasEntity($hasEntity) 
    {
        $this->hasEntity = $hasEntity;
    }
    
    public function getGenerateFieldset() 
    {
        return $this->generateFieldset;
    }

    public function setGenerateFieldset($generateFieldset) 
    {
        $this->generateFieldset = $generateFieldset;
    }
    
    public function getGridActions() 
    {
        return $this->gridActions;
    }

    public function setGridActions($gridActions) 
    {
        $this->gridActions = $gridActions;
    }
}

?>
