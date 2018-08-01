<?php
/**
 * File directories and paths
 */
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('WWW', ROOT . DS . 'public');
define('APP', ROOT . DS . 'app');
define('CORE', ROOT . DS . 'vendor' . DS . 'fw' . DS . 'core');
define('LIBS', ROOT . DS . 'vendor' . DS . 'fw' . DS . 'core' . DS . 'libs');
define('CACHE', ROOT . DS . 'tmo' . DS . 'cache');
define('CONF', ROOT . DS . 'config');

//Finding base URL of application
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://'; // finding protocol for app path
$app_path = "{$protocol}{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
$app_path = preg_replace('#[^/]+$#','',$app_path);
$app_path = str_replace("/public/",'',$app_path);
define('BASE_URL',$app_path);

define('ADMIN', BASE_URL.'/adm'); // Admin/manager panel path

/**
 * Application config
 */
define('DEBUG', 1); // 1 - developer mode: show all errors, 0 - production mode: hide all errors, log to file
define('LAYOUT', 'default'); // default template

require_once ROOT.DS.'vendor'.DS.'autoload.php';


