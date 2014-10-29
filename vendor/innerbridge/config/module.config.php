<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Innerbridge;

return array(
    
    'controllers' => array(
        'invokables' => array(
            'Innerbridge\Controller\Controller' => 'Innerbridge\Controller\Controller',
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
