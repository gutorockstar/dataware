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
        $urlHelper = $this->getUrlHelper();
        
        $content = "<a class='action-grid' 
                       title='{$gridAction->getTitle()}' 
                       href='{$urlHelper($gridAction->getRoute(), $gridAction->getArgs())}' 
                       onClick='{$gridAction->getOnClick()}'>
                        <i class='fa {$gridAction->getCssClass()} fa-lg'></i>
                    </a>";
        
        return $content;
    }
}

?>
