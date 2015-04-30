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
use System\Model\BreadCrumb;

class BreadCrumbHelper extends ViewHelper
{
    public function __invoke(BreadCrumb $tree = null) 
    {
        // Migalha de pão.
        return "<div class='tree'>
                    <font>Teste migalha de pão</font>
                </div>";
    }
}

?>
