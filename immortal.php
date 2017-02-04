<?php
define('APP_TIME', microtime(true));
define('APP_ROOT', __DIR__);
define('DEV_ENV', true);

define('ASSET_ROOT', 'http://' . $_SERVER['HTTP_HOST'] . str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', APP_ROOT) . '/public'));

date_default_timezone_set('UTC');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (version_compare(PHP_VERSION, '5.4', '<') === true)
{
    die('Please update your PHP version, Requires PHP v5.4 or Above! \n');
}

register_shutdown_function(function ($startTime)
{
    echo '<script>console.log("Time: ', number_format((microtime(true) - APP_TIME), 4), ' Seconds");</script>';
}, APP_TIME);

function pr($arr)
{
    echo '<pre>', print_r($arr, true), '</pre>';
}

require 'vendor/autoload.php';
require 'routes/web.php';
