<?php
return [
    'db' => [
        'adapters' => [
            'spotifake' => [
                'database' => 'spotifake',
                'driver' => 'PDO_Mysql',
                'hostname' => 'localhost',
                'username' => 'spotifake',
                'password' => 'spotifake',
                'port' => '3306',
                'driver_options' => [
                    1002 => 'SET NAMES \'UTF8\'',
                ],
            ],
        ],
    ],
];
