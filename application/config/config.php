<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);


define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

/**
 * PHP.ini
 * Protect against session fixation from attacker
 */
ini_set('session.use_only_cookies', true);
ini_set('session.use_trans_sid', false);


/**
 * Configuration for: Database
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'logger');

define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_CHARSET', 'utf8');