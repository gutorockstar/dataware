<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TabHelper
 *
 * @author augusto
 */
namespace System\View\Helper;

use System\View\Helper\ViewHelper;
use System\Model\Tab;

class TabHelper extends ViewHelper
{
    public function __invoke(Array $tabs) 
    {
        $tabRender = "<fieldset>
                          <ul class='nav nav-tabs'>";
        
        if ( count($tabs) > 0 )
        {
            foreach ( $tabs as $tab )
            {
                if ( $tab instanceof Tab)
                {
                    $activeTabCssClass = $tab->getActive() ? "active" : "";
                    $tabRender .= "<li role='presentation' class='{$activeTabCssClass}'><a href='#'>{$tab->getTitle()}</a></li>";
                }
            }
        }
        
        $tabRender .= "   </ul>
                      </fieldset>";
        
        return $tabRender;
    }
}

?>
