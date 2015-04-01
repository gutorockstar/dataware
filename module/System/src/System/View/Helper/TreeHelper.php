<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TreeHelper
 *
 * @author augusto
 */
namespace System\View\Helper;

use System\View\Helper\ViewHelper;
use System\Model\Tree;

class TreeHelper extends ViewHelper
{
    public function __invoke(Tree $tree = null) 
    {
        return "<div class='tree'>
                    <font>Teste árvore</font>
                </div>";
    }
}

?>
