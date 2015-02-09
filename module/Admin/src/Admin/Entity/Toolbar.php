<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Toolbar
 *
 * @author augusto
 */
namespace Admin\Entity;

class Toolbar 
{    
    const TB_ACTION_NEW = 'tb_action_new';
    const TB_ACTION_EDIT = 'tb_action_edit';
    const TB_ACTION_DELETE = 'tb_action_delete';
    const TB_ACTION_SEARCH = 'tb_action_search';
    const TB_ACTION_UNIFY = 'tb_action_unify';
    const TB_ACTION_CLONE = 'tb_action_clone';    
    const TB_ACTION_PRINT = 'tb_action_print';
    const TB_ACTION_BACK = 'tb_action_back';
    
    private $toolbarActions = array();
    
    public function __construct($toobarActions = array())
    {
        $this->toolbarActions = $toobarActions;
    }
    
    public function getToolbarActions() 
    {
        return $this->toolbarActions;
    }

    public function setToolbarActions(Array $toolbarActions) 
    {
        $this->toolbarActions = $toolbarActions;
    }
    
    public function addToolbarAction(ToolbarAction $toolbarAction)
    {
        $this->toolbarActions[$toolbarAction->getId()] = $toolbarAction;
    }
    
    public function disableToolbarAction($toolbarActionId)
    {        
        $this->toolbarActions[$toolbarActionId]->setEnabled(false);
    }
    
    public function removeToolbarAction($toolbarActionId)
    {
        unset($this->toolbarActions[$toolbarActionId]);
    }
}

?>
