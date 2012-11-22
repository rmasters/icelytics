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
        'routes' => array(),
    ),

    'controllers' => array(
        'invokables' => array(),
    ),

    'view_manager' => array(
        'template_path_stack' => array(__DIR__ . '/../view'),
    ),
);
