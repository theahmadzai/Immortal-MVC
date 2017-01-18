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

date_default_timezone_set('UTC');

require '/../app/bootstrap/Autoloader.php';

Autoloader::map([
    __DIR__ . '/../app/core',
    __DIR__ . '/../app/helpers',
]);

require '/../app/bootstrap/routes.php';

$App = new App();
