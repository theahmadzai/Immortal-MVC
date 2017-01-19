<?php
function pr($arr)
{
    echo '<pre>', print_r($arr, true), '</pre>';
}

/**----------------------------------------------------------------------------------------*/

if (version_compare(PHP_VERSION, '5.4', '<') === true)
{
    die('Please update your PHP version, Requires PHP v5.4 or Above! \n');
}

define('DEV_ENV', true);
define('APP', __DIR__ . '/../app/');

date_default_timezone_set('UTC');

if (DEV_ENV === true)
{
    $startTime = microtime(true);

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    register_shutdown_function(function ($startTime)
    {
        echo '<script>console.log("Time: ', number_format((microtime(true) - $startTime), 4), ' Seconds");</script>';
    }, $startTime);

}
else
{
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
}

require '/../app/Autoloader.php';

Autoloader::map([
    'files'   => ['config', 'http'],
    'classes' => ['core', 'helpers', 'exceptions', 'models'],
]);

$App = new App();
