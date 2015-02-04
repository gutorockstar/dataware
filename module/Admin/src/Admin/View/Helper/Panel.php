<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form
 *
 * @author augusto
 */
namespace Admin\View\Helper;

use Admin\View\Helper\ViewHelper;

class Panel extends ViewHelper
{
    /**
     * Cria painel contendo o conteúdo recebido por parâmetro.
     * 
     * @param String $header
     * @param String $title
     * @param String html $body
     * @param String html $toolbar
     * @return String html
     */
    public function __invoke($title, $body, $toolbar = null, $style = null, $cssClassIcon = null, $header = null)
    {
        if ( !is_null($header) )
        {
            $head = "<div class='view-header'>
                         <font>{$header}</font>
                     </div>";
        }
        
        return "<div class='row' style='{$style}'>
                    {$head}
                    
                    {$toolbar}
                        
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h3 class='panel-title'><i class='fa {$cssClassIcon}'></i>&nbsp;&nbsp;{$title}</h3>
                        </div>
                        
                        <div class='panel-body'>
                            <div class='container'>
                                {$body}
                            </div>
                        </div>
                    </div>
                </div>";
    }
}
