<?php
/**
 * Icelytics
 *
 * @author    Ross Masters <ross@rossmasters.com>
 * @link      http://github.com/rmasters/icelytics
 * @copyright Copyright (c) 2012 Ross Masters
 * @license   http://github.com/rmasters/icelytics/blog/masters/LICENSE
 */

// Detect if we're running development mode
$dev = isset($_SERVER, $_SERVER['APPLICATION_ENV']) ?
    $_SERVER['APPLICATION_ENV'] == 'development' : false;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'dashboard' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/dashboard',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Dashboard',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Dashboard' => 'Application\Controller\DashboardController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => $dev,
        'display_exceptions'       => $dev,
        'doctype'                  => 'HTML5',
        'not_found_template'       => $dev ? 'error/404.dev' : 'error/404',
        'exception_template'       => 'error/index',
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'assetic_configuration' => array(
        'default' => array(
            'assets' => array(
                '@base_css',
                '@base_js',
//                '@base_img',
            ),
        ),
        'routes' => array(
            'dashboard' => array(
                '@base_css',
                '@base_js',
                '@highcharts_js',
                '@dashboard',
            ),
        ),
        'modules' => array(
            'application' => array(
                'root_path' => __DIR__ . '/../assets',
                'collections' => array(
                    // CSS (bootstrap)
                    'base_css' => array(
                        'assets' => array(
                            'bootstrap/css/bootstrap.min.css',
                            'bootstrap/css/bootstrap-responsive.min.css',
                        ),
                        'filters' => array(
                            'CssRewriteFilter' => array(
                                'name' => 'Assetic\Filter\CssRewriteFilter',
                            ),
                        ),
                        'options' => array(),
                    ),
                    // JS (jQuery + bootstrap)
                    'base_js' => array(
                        'assets' => array(
                            '//code.jquery.com/jquery.min.js',
                            'bootstrap/js/bootstrap.min.js',
                        ),
                    ),
                    // Images (bootstrap)
                    'base_img' => array(
                        'assets' => array(
                            'bootstrap/img/*.png',
                        ),
                        'options' => array(
                            'move_raw' => true,
                        ),
                    ),
                    // Scripts used on dashboard
                    'dashboard' => array(
                        'assets' => array(
                            'live.js',
                        ),
                    ),
                ),
            ),
        ),
    ),
);
