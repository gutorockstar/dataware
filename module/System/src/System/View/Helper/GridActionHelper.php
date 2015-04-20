<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GridActionHelper
 *
 * @author augusto
 */
namespace System\View\Helper;

use System\Model\GridAction;

class GridActionHelper extends ViewHelper
{
    public function __invoke(GridAction $gridAction) 
    {
        $content = "<a class='action-grid' title='{$gridAction->getTitle()}' href='{$gridAction->getHref()}' onClick='{$gridAction->getOnClick()}'>
                        <i class='{$gridAction->getCssClass()}'></i>
                    </a>";
        
        return $content;
    }
}

?>