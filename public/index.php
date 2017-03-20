<?php


/**
 * PHP-Logger
 * Persistent log system
 * All URL:s will go through the front controller to determine which controller the request is
 * and will view the correspond views
 * @author Jakob Wångö (jv222dp@student.lnu.se)
 *
 */

// Defines the application root directories
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

// Load application config (db config, error reporting)
require APP . 'config/config.php';

session_start();

// Load core application classes
require APP . 'core/frontcontroller.php';
require APP . 'core/corecontroller.php';

require APP . 'model/Logger.php';

// Start the front controller and handle the URL request
$controller = new FrontController();

$controller->handleRequest();