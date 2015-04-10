<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author augusto
 */
namespace System\Model;

class View 
{
    /**
     * @var System\Entity\Tree
     */
    private $tree;
    
    /**
     * @var System\Entity\Toolbar
     */
    private $toolbar;
    
    /**
     * @var System\Entity\Panel
     */
    private $panel;
    
    public function getTree() 
    {
        return $this->tree;
    }

    public function setTree($tree) 
    {
        $this->tree = $tree;
    }

    public function getToolbar() 
    {
        return $this->toolbar;
    }

    public function setToolbar($toolbar) 
    {
        $this->toolbar = $toolbar;
    }

    public function getPanel() 
    {
        return $this->panel;
    }

    public function setPanel($panel) 
    {
        $this->panel = $panel;
    }
}

?>
