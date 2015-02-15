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
namespace Admin\Entity;

use Admin\Entity\GridColumn;

class Grid 
{
    private $columns = array();
    private $data;
    private $disableSelections = false;
    
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
        
    public function getDisableSelections() 
    {
        return $this->disableSelections;
    }

    public function setDisableSelections($disableSelections) 
    {
        $this->disableSelections = $disableSelections;
    }
}

?>
