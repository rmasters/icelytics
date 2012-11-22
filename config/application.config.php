<?php
return array(
    'modules' => array(
        // Libraries
        'DoctrineModule',
        'DoctrineORMModule',
        'ZfcTwig',
        'AsseticBundle',

        // Application modules
        'Application',
        'Listeners',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);
