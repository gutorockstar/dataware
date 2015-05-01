<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TreeMenu
 *
 * @author augusto
 */
namespace System\Model;

class TreeMenu 
{
    private $content;
    
    public function __construct(Array $content)
    {
        $this->content = $content;
    }
    
    public function getContent() 
    {
        return $this->content;
    }

    public function setContent($content) 
    {
        $this->content = $content;
    }
}

?>
