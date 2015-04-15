<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tab
 *
 * @author augusto
 */
namespace System\Model;

class Tab 
{
    /**
     *
     * @var String
     */
    private $title;
    
    /**
     *
     * @var String html
     */
    private $content;
    
    /**
     *
     * @var boolean
     */
    private $active;


    public function __construct($title, $content = null, $active = false) 
    {
        $this->title = $title;
        $this->content = $content;
        $this->active = $active;
    }
    
    public function getTitle() 
    {
        return $this->title;
    }

    public function setTitle($title) 
    {
        $this->title = $title;
    }

    public function getContent() 
    {
        return $this->content;
    }

    public function setContent($content) 
    {
        $this->content = $content;
    }
    
    public function getActive() 
    {
        return $this->active;
    }

    public function setActive($active) 
    {
        $this->active = $active;
    }


}

?>
