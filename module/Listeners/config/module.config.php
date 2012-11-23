<?php
/**
 * Icelytics
 *
 * @author    Ross Masters <ross@rossmasters.com>
 * @link      http://github.com/rmasters/icelytics
 * @copyright Copyright (c) 2012 Ross Masters
 * @license   http://github.com/rmasters/icelytics/blog/masters/LICENSE
 */

namespace Listeners;

return array(
    'doctrine' => array(
        'driver' => array(
            'orm_default' => array(
                'paths' => array(
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity',
                ),
            ),
        ),
    ),

    'router' => array(
        'routes' => array(
            'listeners' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/listeners',
                    'defaults' => array(
                        'controller' => 'Listeners\Controller\Listener',
                    ),
                ),
                'child_routes' => array(
                    // Data endpoints
                    'data' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/data',
                            'defaults' => array(
                                'controller' => 'Listeners\Controller\Data',
                            ),
                        ),
                        'child_routes' => array(
                            // Listener counts over the past twenty four hours
                            '24h' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route' => '/today.json',
                                    'defaults' => array(
                                        'action' => 'today',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'Listeners\Controller\Data' => 'Listeners\Controller\DataController',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(__DIR__ . '/../view'),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),

    'assetic_configuration' => array(
        'modules' => array(
            'listeners' => array(
                'root_path' => __DIR__ . '/../assets',
                'collections' => array(
                    // HighCharts
                    'highcharts_js' => array(
                        'assets' => array(
                            'highcharts/highcharts.js',
                            'highcharts/exporting.js',
                        ),
                    ),
                ),
            ),
        ),
    ),
);
