<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TecnonMenuView
 *
 * @author augusto
 */

namespace Tecnon\View\Helper;

use Tecnon\View\tViewHelper,
    Zend\Session\Container;

class tMenu extends tViewHelper
{    
    public function __invoke($namespace = null)
    {
        $admUnitAccess   = $this->getEntityManager()->getRepository('Admin\Entity\AdmUnitAccess');
        $admGroupUser    = $this->getEntityManager()->getRepository('Admin\Entity\AdmGroupUser');
        $admModuleAccess = $this->getEntityManager()->getRepository('Admin\Entity\AdmModuleAccess');
        
        $userSession = new Container('user');
        $userid      = $userSession->userid;
        
        // Obtém as unidades que o usuário possui acesso.
        $unitsAccess = $admUnitAccess->findBy(array('userid' => $userid, 'status' => DB_TRUE));
        
        foreach ( $unitsAccess as $unitAccess )
        {
            // Obtém os grupos no qual o usuário da unidade pertence.
            $groupsUser = $admGroupUser->findBy(array('unitaccessid' => $unitAccess->__get('unitaccessid')));
            
            foreach ( $groupsUser as $groupUser )
            {
                // Obtém os módulos que o grupo do usuário da unidade possui acesso.
                $modulesAccess = $admModuleAccess->findBy(array('groupid' => $groupUser->__get('groupid')));
                $modules = array();
                
                foreach ( $modulesAccess as $moduleAccess )
                {   
                    // Obtém as informações do módulo.
                    $module   = $moduleAccess->__get('module'); 
                    $moduleData = array(
                        'moduleid' => $module->__get('moduleid'),
                        'name' => $module->__get('name'),
                        'label' => $module->__get('label')
                    );
                    
                    if ( $module->__get('status') == DB_TRUE )
                    {
                        if ( !in_array($moduleData, $modules) )
                        {
                            
                            
                            
                            $modules[] = $moduleData;
                            
                            
                            
                        }
                    }
                }
            }
        }
        
        return "Aqui";
    }
}

?>
