<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tLookup
 *
 * @author augusto
 */
namespace Tecnon\Component\Form;

use Zend\Form\Element;

class Lookup extends Element
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'text',
        'onClick' => "javascript:this.value = ''"
    );
}
