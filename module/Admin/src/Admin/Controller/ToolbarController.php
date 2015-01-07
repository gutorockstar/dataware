<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ToolbarController
 *
 * @author augusto
 */
namespace Admin\Controller;

use Admin\Controller\Controller;
use Admin\Entity\Toolbar;
use Admin\Entity\ToolbarOption;

class ToolbarController extends Controller
{    
    private $toolbar;
    
    /**
     * Método construtor do controlador da barra de ferramentas.
     * 
     * @param \Admin\Entity\ToolbarOption $toolbarOptions
     */
    public function __construct($toolbarOptions = array())
    {        
        foreach ( $toolbarOptions as $toolbarOption )
        {
            
        }
        
        $this->toolbar = new Toolbar();
    }
    
    /**
     * Monta a ação que a toolbar deve executar.
     * 
     * @param \Admin\Entity\ToolbarOption $toolbarOption
     * @return \Admin\Entity\ToolbarOption
     */
    private function generateActionOption(ToolbarOption $toolbarOption)
    {        
        if ( $toolbarOption->getEnabled() )
        {   
            if ( !$toolbarOption->getIsJQGridAction() )
            {
                $currentUrl = $this->getCurrentUrl();                
                $explodeUrl = explode("/", $currentUrl);                
                $explodeUrl[] = $toolbarOption->getAction();

                $tbOptionAction = implode("/", $explodeUrl);
                $toolbarOption->setAction($tbOptionAction);
            }
        }
        else
        {
            $toolbarOption->setAction(null);
            $toolbarOption->setCssIconClass($toolbarOption->getCssIconClass() . Toolbar::CSS_CLASS_DISABLE_TOOLBAR);
        }
        
        return $toolbarOption;
    }
    
    /**
     * Retorna a toolbar com todas suas opções até o momento.
     * 
     * @return \Admin\Entity\Toolbar
     */
    public function getToolbar()
    {
        return $this->toolbar;
    }
    
    /**
     * Adiciona opção à toolbar.
     * 
     * @param \Admin\Entity\ToolbarOption $toolbarOption
     */
    public function addToolbarOption(ToolbarOption $toolbarOption)
    {        
        $toolbarOptions = $this->toolbar->getToolbarOptions();
        
        if ( is_null($toolbarOptions[$toolbarOption->getId()]) )
        { 
            $toolbarOptions[] = $this->generateActionOption($toolbarOption);
        }
        
        $this->toolbar->setToolbarOptions($toolbarOptions);
    }
    
    /**
     * Remove opção da toolbar;
     * 
     * @param int $idToolbarOption
     */
    public function removeToolbarOption(int $idToolbarOption)
    {
        $toolbarOptions = $this->toolbar->getToolbarOptions();
        unset($toolbarOptions[$idToolbarOption]);
        
        $this->toolbar->setToolbarOptions($toolbarOptions);
    }
}

?>
