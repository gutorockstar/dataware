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
namespace Tecnon\View;

use Tecnon\View\ViewHelper;

class Panel extends ViewHelper
{
    /**
     * Cria painel de um formulário o conteúdo por parâmetro
     * 
     * @param String html $insideElements
     */
    public function __invoke($content)
    {
        return "<nav class='navbar navbar-default nav-panel'>
                    {$content}
                </nav>";
    }
}
