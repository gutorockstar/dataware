<?php

/**
 * Rodar o seguinte comando para criação da extrutura da base de dados 
 * após criada e ajustadas as configurações:
 *
 * ./vendor/bin/doctrine-module orm:schema-tool:create
 */

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    //'port'     => '5432',
                    'user'     => 'root',
                    'password' => 'root',
                    'dbname'   => 'site',
                )
            )
        )
    )
);
