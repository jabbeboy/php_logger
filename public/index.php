<?php

session_start();

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

// load application config (error reporting etc.)
require APP . 'config/config.php';

// FOR DEVELOPMENT: this loads PDO-debug, a simple function that shows the SQL query (when using PDO).
// load application class
require APP . 'core/application.php';
require APP . 'core/controller.php';

// start the application
$application = new Application();
