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
namespace Admin\Object;

use Admin\Object\GridColumn;

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
}

?>
