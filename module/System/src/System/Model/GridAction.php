<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GridAction
 *
 * @author augusto
 */
namespace System\Model;

class GridAction 
{
    const GRID_ACTION_EDIT_ID = 'action_edit';
    const GRID_ACTION_DELETE_ID = 'action_delete';
    const GRID_ACTION_VIEW_ID = 'action_view';
    const GRID_ACTION_ATTACHMENT_ID = 'action_attachment';
    
    /**
     *
     * @var String 
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
    private $cssClass;
    
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
    
    /**
     *
     * @var boolean
     */
    private $enable;
    
    /**
     *
     * @var boolean
     */
    private $visible;
    
    public function __construct($id, $title, $cssClass, $href, $onClick = null, $enable = true, $visible = true) 
    {
        $this->id = $id;
        $this->title = $title;
        $this->cssClass = $cssClass;
        $this->href = $href;
        $this->onClick = $onClick;
        $this->enable = $enable;
        $this->visible = $visible;
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

    public function getCssClass() 
    {
        return $this->cssClass;
    }

    public function setCssClass($cssClass) 
    {
        $this->cssClass = $cssClass;
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

    public function getEnable() 
    {
        return $this->enable;
    }

    public function setEnable($enable) 
    {
        $this->enable = $enable;
    }

    public function getVisible() 
    {
        return $this->visible;
    }

    public function setVisible($visible) 
    {
        $this->visible = $visible;
    }
}

?>
