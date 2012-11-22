<?php
/**
 * Icelytics
 *
 * @author    Ross Masters <ross@rossmasters.com>
 * @link      http://github.com/rmasters/icelytics
 * @copyright Copyright (c) 2012 Ross Masters
 * @license   http://github.com/rmasters/icelytics/blog/masters/LICENSE
 */

chdir(dirname(__DIR__));

include 'init_autoloader.php';

Zend\Mvc\Application::init(include 'config/application.config.php');
