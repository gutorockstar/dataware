<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TecnonPanelView
 *
 * @author augusto
 */
namespace Tecnon\View;

use Tecnon\View\ViewHelper;

class Panel extends ViewHelper
{
    /**
     * Cria painel recebendo o conteúdo por parâmetro
     * 
     * @param String html $insideElements
     */
    public function __invoke($header = null, $insideContent = null, $style = null)
    {
        $panel = "<nav class='navbar navbar-default' style='{$style}'>
                    <fieldset>
                        <legend>{$header}</legend>
                        {$insideContent}
                    </fieldset>
                  </nav>";
        
        /**
        $panel = "<div class='panelBase'>
                    <div class='panel panel-default' style='{$style}'>
                        <div class='panel-heading'>
                            <div class='heading'>{$header}</div>
                        </div>
                        <div class='panel-body'>
                            <div class='insideContent'>
                                {$insideContent}
                            </div>
                        </div>
                    </div>
                  </div>";
         * 
         */
        
        return $panel;
    }
}

?>
