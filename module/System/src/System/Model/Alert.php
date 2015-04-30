<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Alert
 *
 * @author augusto
 */
namespace System\Model;

class Alert 
{
    private $message;
    private $type;
    private $showButtonClose;
    
    public function __construct($message, $type = 'danger', $showButtonClose = true) 
    {
        $this->message = $message;
        $this->type = $type;
        $this->showButtonClose = $showButtonClose;
    }
    
    public function getMessage() 
    {
        return $this->message;
    }

    public function setMessage($message) 
    {
        $this->message = $message;
    }

    public function getType() 
    {
        return $this->type;
    }

    public function setType($type) 
    {
        $this->type = $type;
    }

    public function getShowButtonClose() 
    {
        return $this->showButtonClose;
    }

    public function setShowButtonClose($showButtonClose) 
    {
        $this->showButtonClose = $showButtonClose;
    }
}

?>
