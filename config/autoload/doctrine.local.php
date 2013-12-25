<?php

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
                    'dbname'   => 'zend_application',
                )
            )
        )
    )
);
