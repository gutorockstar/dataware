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
namespace Sysma\View\Helper;

use Sysma\View\Helper\ViewHelper;

class View extends ViewHelper
{
    /**
     * Cria nova view recebendo o conteúdo por parâmetro
     * 
     * @param String html $insideElements
     */
    public function __invoke($header = null, $viewContent = array(), $styles = array())
    {
        if ( count($styles) > 0 )
        {
            foreach ( $styles as $attribute => $value )
            {
                $style .= "{$attribute}:$value;";
            }
        }
        
        $view = "<fieldset style='{$style}'>
                     <legend>{$header}</legend>";
        
        if ( count($viewContent) > 0 )
        {
            foreach ( $viewContent as $content )
            {
                $view .= $content;
            }
        }
        else
        {
            $view .= "<p>Nenhum conteúdo encontrado...</p>";
        }
                    
        $view .= "</fieldset>";
        
        return $view;
    }
}

?>
