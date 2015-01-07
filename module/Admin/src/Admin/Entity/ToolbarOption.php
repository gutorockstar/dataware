<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ToolbarOption
 *
 * @author augusto
 */
namespace Admin\Entity;

class ToolbarOption 
{
    /**
     *
     * @var int
     */
    private $id;
    
    /**
     *
     * @var String
     */
    private $title;
    
    /**
     *
     * @var String
     */
    private $action;
    
    /**
     * http://fortawesome.github.io/Font-Awesome/icons/
     * 
     * @var String
     */
    private $cssClass;
    
    /**
     *
     * @var boolean
     */
    private $enabled;
    
    /**
     * Método construtor da classe ToolbarOption
     * 
     * @param String $id
     * @param String $title
     * @param String $action
     * @param String $cssClass
     * @param boolean $enabled
     */
    public function __construct($id, $title, $action, $cssClass, $enabled = true)
    {
        $this->id = $id;
        $this->title = $title;
        $this->action = $action;
        $this->cssClass = $cssClass;
        $this->enabled = $enabled;
    }
    
    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getTitle() 
    {
        return $this->title;
    }

    public function setTitle($title) 
    {
        $this->title = $title;
    }

    public function getAction() 
    {
        return $this->action;
    }

    public function setAction($action) 
    {
        $this->action = $action;
    }
    
    /**
     * http://fortawesome.github.io/Font-Awesome/icons/
     * 
     * @return type
     */
    public function getCssClass() 
    {
        return $this->cssClass;
    }

    public function setCssClass($cssClass) 
    {
        $this->cssClass = $cssClass;
    }
    
    public function getEnabled() 
    {
        return $this->enabled;
    }

    public function setEnabled($enabled) 
    {
        $this->enabled = $enabled;
    }
}

?>
