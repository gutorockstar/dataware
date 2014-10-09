<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sysma;

return array(
    
    'controllers' => array(
        'invokables' => array(
            'Sysma\Controller\Controller' => 'Sysma\Controller\Controller',
        ),
    ),
    
    // definir gerenciador de servicos
    'service_manager' => array(
        'factories' => array(
            //'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    )
);

?>
