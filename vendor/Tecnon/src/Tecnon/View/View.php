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

class View extends ViewHelper
{
    /**
     * Cria nova view recebendo o conteúdo por parâmetro
     * 
     * @param String html $insideElements
     */
    public function __invoke($header = null, $insideContent = null, $style = null)
    {
        $panel = "<fieldset style='{$style}'>
                    <legend>{$header}</legend>
                    {$insideContent}
                  </fieldset>";
        
        return $panel;
    }
}

?>
