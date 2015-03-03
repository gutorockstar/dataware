<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Panel
 *
 * @author augusto
 */
namespace Admin\Object;

class Panel 
{
    /**
     * @return String
     */
    private $cssClassIcon;
    
    /**
     * @return String
     */
    private $title;
    
    /**
     * @return String html
     */
    private $body;
    
    /**
     * @return String
     */
    private $style;
    
    public function __construct($title, $body = null, $cssClassIcon = null, $style = null)
    {
        $this->title = $title;
        $this->body = $body;
        $this->cssClassIcon = $cssClassIcon;
        $this->style = $style;
    }
    
    public function getCssClassIcon() 
    {
        return $this->cssClassIcon;
    }

    public function setCssClassIcon($cssClassIcon) 
    {
        $this->cssClassIcon = $cssClassIcon;
    }
        
    public function getTitle() 
    {
        return $this->title;
    }

    public function setTitle($title) 
    {
        $this->title = $title;
    }

    public function getBody() 
    {
        return $this->body;
    }

    public function setBody($body) 
    {
        $this->body = $body;
    }

    public function getStyle() 
    {
        return $this->style;
    }

    public function setStyle($style) 
    {
        $this->style = $style;
    }
}

?>
