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
namespace Innerbridge\Controller;

use Innerbridge\Controller\Controller;
use Innerbridge\Entity\Toolbar;
use Innerbridge\Entity\ToolbarOption;

class ToolbarController extends Controller
{    
    private $toolbar;
    
    /**
     * Método construtor do controlador da barra de ferramentas.
     * 
     * @param \Innerbridge\Entity\ToolbarOption $toolbarOptions
     */
    public function __construct($toolbarOptions = array())
    {
        $tbOptions = array();
            
        if ( !(count($toolbarOptions) > 0) )
        {
            // Sempre serão criadas as ferramentas padrões.
            $toolbarOptions = array(
                Toolbar::ID_OPTION_NEW => new ToolbarOption(Toolbar::ID_OPTION_NEW, Toolbar::TITLE_OPTION_NEW, Toolbar::ACTION_OPTION_NEW, Toolbar::CSS_CLASS_ICON_OPTION_NEW, true),
                Toolbar::ID_OPTION_VIEW => new ToolbarOption(Toolbar::ID_OPTION_VIEW, Toolbar::TITLE_OPTION_VIEW, Toolbar::ACTION_OPTION_VIEW, Toolbar::CSS_CLASS_ICON_OPTION_VIEW, true),
                Toolbar::ID_OPTION_SEARCH => new ToolbarOption(Toolbar::ID_OPTION_SEARCH, Toolbar::TITLE_OPTION_SEARCH, Toolbar::ACTION_OPTION_SEARCH, Toolbar::CSS_CLASS_ICON_OPTION_SEARCH, true),
                Toolbar::ID_OPTION_REFRESH => new ToolbarOption(Toolbar::ID_OPTION_REFRESH, Toolbar::TITLE_OPTION_REFRESH, Toolbar::ACTION_OPTION_REFRESH, Toolbar::CSS_CLASS_ICON_OPTION_REFRESH, true),
                Toolbar::ID_OPTION_FILTER => new ToolbarOption(Toolbar::ID_OPTION_FILTER, Toolbar::TITLE_OPTION_FILTER, Toolbar::ACTION_OPTION_SEARCH, Toolbar::CSS_CLASS_ICON_OPTION_FILTER, true),
                Toolbar::ID_OPTION_PRINT => new ToolbarOption(Toolbar::ID_OPTION_PRINT, Toolbar::TITLE_OPTION_PRINT, Toolbar::ACTION_OPTION_PRINT, Toolbar::CSS_CLASS_ICON_OPTION_PRINT),
                Toolbar::ID_OPTION_BACK => new ToolbarOption(Toolbar::ID_OPTION_BACK, Toolbar::TITLE_OPTION_BACK, Toolbar::ACTION_OPTION_BACK, Toolbar::CSS_CLASS_ICON_OPTION_BACK),
            );
            
            // Para criar as ações das opções.
            foreach ( $toolbarOptions as $tbOption )
            {
                $tbOptions[$tbOption->getId()] = $this->generateActionOption($tbOption);
            }
        }
        
        $this->toolbar = new Toolbar($tbOptions);
    }
    
    /**
     * Monta a ação que a toolbar deve executar.
     * 
     * @param \Innerbridge\Entity\ToolbarOption $toolbarOption
     * @return \Innerbridge\Entity\ToolbarOption
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
     * @return \Innerbridge\Entity\Toolbar
     */
    public function getToolbar()
    {
        return $this->toolbar;
    }
    
    /**
     * Adiciona opção à toolbar.
     * 
     * @param \Innerbridge\Entity\ToolbarOption $toolbarOption
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
