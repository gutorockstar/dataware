<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteMiniPanelHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;
use System\Model\Panel;

class SiteMiniPanelHelper extends ViewHelper
{
    public function __invoke(Panel $panel) 
    {
        $miniPanelContent = "<div class='mini-panel'>
                                 <div class='mini-panel-header'>
                                     <i class='fa {$panel->getCssClassIcon()}'></i>&nbsp;&nbsp;{$panel->getTitle()}
                                 </div>
                                 <div class='mini-panel-body'>
                                     {$panel->getBody()}
                                 </div>
                             </div>";
        
        return $miniPanelContent;
    }
}

?>
