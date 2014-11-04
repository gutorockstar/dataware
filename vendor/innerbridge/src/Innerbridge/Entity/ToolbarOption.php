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
namespace Innerbridge\Entity;

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
     *
     * @var String
     */
    private $cssIconClass;
    
    /**
     *
     * @var boolean
     */
    private $enabled;
    
    /**
     *
     * @var String
     */
    private $method;
    
    /**
     *
     * @var String
     */
    private $href;
    
    /**
     *
     * @var String
     */
    private $onClick;
    
    public function __construct($id, $title, $action, $cssIconClass, $enabled = true, $method = Toolbar::METHOD_ACTION_AJAX, $href = null, $onClick = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->action = $action;
        $this->cssIconClass = $cssIconClass;
        $this->enabled = $enabled;
        $this->method = $method;
        $this->href = $href;
        $this->onClick = $onClick;
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

    public function getCssIconClass() 
    {
        return $this->cssIconClass;
    }

    public function setCssIconClass($cssIconClass) 
    {
        $this->cssIconClass = $cssIconClass;
    }

    public function getEnabled() 
    {
        return $this->enabled;
    }

    public function setEnabled($enabled) 
    {
        $this->enabled = $enabled;
    }
    
    public function getMethod() 
    {
        return $this->method;
    }

    public function setMethod($method) 
    {
        $this->method = $method;
    }
    
    public function getHref() 
    {
        return $this->href;
    }

    public function setHref($href) 
    {
        $this->href = $href;
    }
    
    public function getOnClick() 
    {
        return $this->onClick;
    }

    public function setOnClick($onClick) 
    {
        $this->onClick = $onClick;
    }


}

?>
