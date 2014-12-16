<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Toolbar
 *
 * @author augusto
 */
namespace Innerbridge\View\Helper;

use Innerbridge\Entity\Toolbar;
use \Innerbridge\Entity\ToolbarOption;
use Innerbridge\Controller\ToolbarController;

use Innerbridge\View\Helper\ViewHelper;
use Zend\Session\Container;

class ToolbarHelper extends ViewHelper
{   
    /**
     * Carrega a toolbar conforme parâmetros.
     * 
     * @return String html
     */
    public function __invoke()
    {
        $userSession = new Container('user');
        $username = $userSession->username;
        
        $toolbarController = new ToolbarController();
        $toolbarOptions = $toolbarController->getToolbar()->getToolbarOptions();
        
        $toolbarView = "<nav class='navbar navbar-default'>
                        <div class='toolbar'>";
        
        if ( strlen($username) > 0 )
        {
            $toolbarView .= "<div class='tools'>";
            
            if ( count($toolbarOptions) > 0 )
            {
                foreach ( $toolbarOptions as $toolbarOption )
                {
                    $toolbarView .= $this->createToolbarOption($toolbarOption);
                }
            }
            
            $toolbarView .= "</div>";
        }
        
        return $toolbarView . "</div></nav>";
    }
    
    /**
     * Monta e retorna ferramenta da barra de ferramentas.
     * 
     * @param int $id
     * @param String $title
     * @param String $action
     * @param String $cssIconClass
     * @param boolean $enabled
     * @param String $method
     * @return String html
     */
    private function createToolbarOption(ToolbarOption $toolbarOption)
    {
        return "<a id=\"tb_option_{$toolbarOption->getId()}\" title=\"{$toolbarOption->getTitle()}\" href=\"/{$toolbarOption->getAction()}\" >
                    <div class=\"tool\">
                        <i class=\"fa {$toolbarOption->getCssIconClass()} fa-2x\"></i>
                    </div>
                </a>";
    }
}
