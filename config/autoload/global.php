<?php
/**
 * Icelytics
 *
 * @author    Ross Masters <ross@rossmasters.com>
 * @link      http://github.com/rmasters/icelytics
 * @copyright Copyright (c) 2012 Ross Masters
 * @license   http://github.com/rmasters/icelytics/blog/masters/LICENSE
 */

/**
 * Global/cross-install configuration
 *
 * Used for module configuration and project-specific config
 */
return array(
    // Doctrine ORM config
    'doctrine' => array(
        'driver' => array(
            'orm_default' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
            ),
        ),
    ),
);
