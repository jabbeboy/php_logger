<?php


/**
 * PHP-Logger
 * All URL will go through the front controller to determine which controller and view will be showed.
 * @author Jakob Wångö
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

// Load Logger class
require APP . 'model/Logger.php';


// Start the front controller and listen for URL requests
$application = new FrontController();