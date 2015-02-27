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
use Admin\Entity\Panel;

class PanelHelper extends ViewHelper
{
    /**
     * Cria painel contendo o conteúdo recebido por parâmetro.
     * 
     * @param Panel $panel
     */
    public function __invoke(Panel $panel)
    {
        $panelRender = "<div class='panel panel-default' style='{$panel->getStyle()}'>
                            <div class='panel-heading'>
                                <h3 class='panel-title'>
                                    <i class='fa {$panel->getCssClassIcon()}'></i>
                                    &nbsp;&nbsp;
                                    {$panel->getTitle()}
                                </h3>
                            </div>
                            <div class='panel-body'>            
                                <div class='container'>
                                    {$panel->getBody()}
                                </div>
                            </div>
                        </div>";
        
        return $panelRender;
    }
}
