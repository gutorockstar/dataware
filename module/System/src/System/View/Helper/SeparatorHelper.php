<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SeparatorHelper
 *
 * @author augusto
 */
namespace System\View\Helper;

use System\View\Helper\ViewHelper;
use System\Model\Separator;

class SeparatorHelper extends ViewHelper
{
    public function __invoke(Separator $separator = null) 
    {
        $style = ($separator instanceof Separator) ? $separator->getStyle() : "";

        return "<hr style='{$style}'>";
    }
}

?>
