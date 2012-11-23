<?php
return array(
    'modules' => array(
        // Application modules
        'Application',
        'Listeners',

        // Libraries
        'DoctrineModule',
        'DoctrineORMModule',
        'ZfcTwig',
        'AsseticBundle',
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
