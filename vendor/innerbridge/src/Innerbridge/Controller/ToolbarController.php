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

use Zend\Mvc\Controller\Plugin\Url;

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
                Toolbar::ID_OPTION_NEW => new ToolbarOption(Toolbar::ID_OPTION_NEW, Toolbar::TITLE_OPTION_NEW, 'new', Toolbar::CSS_CLASS_ICON_OPTION_NEW, true, 'post'),
                Toolbar::ID_OPTION_SEARCH => new ToolbarOption(Toolbar::ID_OPTION_SEARCH, Toolbar::TITLE_OPTION_SEARCH, Toolbar::ACTION_OPTION_SEARCH, Toolbar::CSS_CLASS_ICON_OPTION_SEARCH),
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
            if ( $toolbarOption->getMethod() === Toolbar::METHOD_ACTION_POST )
            {
                $urlPlugin = new Url();
                $toolbarOption->setHref($urlPlugin->fromRoute($toolbarOption->getAction()));
            }
            else if ( $toolbarOption->getMethod() === Toolbar::METHOD_ACTION_AJAX )
            {
                $toolbarOption->setHref('javascript:void(0)');
                $toolbarOption->setOnClick("document.getElementById('{$toolbarOption->getAction()}').click()");
            }
        }
        else
        {
            $toolbarOption->setAction(null);
            $toolbarOption->setCssIconClass($toolbarOption->getCssIconClass() . 'iToolbarDisabled');
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
    
    /**
     * Retorna a url base da interface.
     * 
     * @return String
     */
    public function getBaseUri()
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        unset($uri[count($uri) - 1]);
        
        $baseUri = implode('/', $uri);
        
        return $baseUri;
    }
}

?>
