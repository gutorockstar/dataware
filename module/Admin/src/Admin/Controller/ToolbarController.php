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
use Admin\Entity\ToolbarAction;

class ToolbarController extends Controller
{    
    /**
     * @var Admin\Toolbar
     */
    private $toolbar;
    
    /**
     * @var boolean
     */
    private $showDefaultToolbarActions = true;
    
    /**
     * @var array
     */
    private $addCustomToolbarActions = array();
    
    /**
     * @var array
     */
    private $disableToolbarActions = array();
    
    /**
     * @var array
     */
    private $removeToolbarActions = array();
    
    /**
     * @var String
     */
    private $currentUrl;
    
    /**
     * Método construtor do controlador da barra de ferramentas.
     * 
     * @param array
     */
    public function __construct($tbOptions = array())
    {      
        $this->currentUrl = $this->getCurrentUrl();
        $this->setToolbarOptions($tbOptions);
    }
    
    /**
     * Seta as configurações da toolbar.
     * 
     * @param type $tbOptions
     */
    public function setToolbarOptions($tbOptions = array())
    {        
        if ( isset($tbOptions['showDefaultToolbarActions']) )
        {
            $this->showDefaultToolbarActions = $tbOptions['showDefaultToolbarActions'];
        }
        
        if ( isset($tbOptions['addCustomToolbarActions']) )
        {
            $this->addCustomToolbarActions = $tbOptions['addCustomToolbarActions'];
        }
        
        if ( isset($tbOptions['disableToolbarActions']) )
        {
            $this->disableToolbarActions = $tbOptions['disableToolbarActions'];
        }
        
        if ( isset($tbOptions['removeToolbarActions']) )
        {
            $this->removeToolbarActions = $tbOptions['removeToolbarActions'];
        }
    }
    
    /**
     * Retorna a toolbar com todas suas opções, conforme configurações.
     * 
     * @return \Admin\Entity\Toolbar
     */
    public function getToolbar()
    {
        $this->toolbar = new Toolbar();
        
        // Verifica se está habilitado para exibir as ações padrões da barra de ferramentas
        if ( $this->showDefaultToolbarActions )
        {
            $this->generateDefaultToolbarActions();
        }
        
        // Verifica se deve criar novas ações para a barra de ferramentas.
        if ( count($this->addCustomToolbarActions) > 0 )
        {
            $this->generateCustomToolbarActions();
        }
        
        // Verifica se deve desabilitar alguma ação da barra de ferramentas.
        if ( count($this->disableToolbarActions) > 0 )
        {
            $this->executeDisableToolbarActions();
        }
        
        // Verifica se deve removar alguma ação da barra de ferramentas.
        if ( count($this->removeToolbarActions) )
        {
            $this->executeRemoveToolbarActions();
        }
        
        return $this->toolbar;
    }
    
    /**
     * Popula o objeto Toolbar $this->toolbar, com as ferramentas
     * padrões da barra de ferramentas.
     */
    private function generateDefaultToolbarActions()
    {
        $this->toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_NEW, 'Novo', $this->currentUrl . '/add', 'fa-file-o'));
        $this->toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_EDIT, 'Editar', $this->currentUrl . '/edit', 'fa-edit'));
        $this->toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_DELETE, 'Excluir', $this->currentUrl . '/delete', 'fa-trash-o'));
        $this->toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_SEARCH, 'Procurar', $this->currentUrl . '/index', 'fa-search'));
        $this->toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_UNIFY, 'Unificar', $this->currentUrl . '/unify', 'fa-share-alt fa-rotate-180'));
        $this->toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_CLONE, 'Clonar', $this->currentUrl . '/clone', 'fa-share-alt'));
        $this->toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_PRINT, 'Imprimir', $this->currentUrl . '/print', 'fa-print'));
        $this->toolbar->addToolbarAction(new ToolbarAction(Toolbar::TB_ACTION_BACK, 'Voltar', $this->currentUrl . '/back', 'fa-arrow-circle-o-left'));
    }
    
    /**
     * Gera novas ações customizadas para a barra de ferramentas.
     */
    private function generateCustomToolbarActions()
    {
        foreach ( $this->addCustomToolbarActions as $customToolbarAction )
        {
            if ( $customToolbarAction instanceof ToolbarAction)
            {
                $this->toolbar->addToolbarAction($customToolbarAction);
            }
        }
    }
    
    /**
     * Desabilita ações da toolbar, conforme confgurações.
     */
    private function executeDisableToolbarActions()
    {
        foreach ( $this->disableToolbarActions as $toolbarAction )
        {
            $this->toolbar->disableToolbarAction($toolbarAction);
        }
    }
    
    /**
     * Remove ações da toolbar, conforme configurações.
     */
    private function executeRemoveToolbarActions()
    {
        foreach ( $this->removeToolbarActions as $toolbarAction )
        {
            $this->toolbar->removeToolbarAction($toolbarAction);
        }
    }
}

?>
