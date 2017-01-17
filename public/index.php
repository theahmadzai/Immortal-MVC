<?php
$startTime = microtime(true);

register_shutdown_function('speedtest', $startTime);

function speedtest($startTime)
{
    echo "<p style='position:fixed; bottom:0; right:0; display:block; background: black; color: white;'>Time:  " . number_format((microtime(true) - $startTime), 4) . " Seconds\n</p>";
};

function pr($arr)
{
    echo '<pre>', print_r($arr, true), '</pre>';
}

/**----------------------------------------------------------------------------------------*/

if (version_compare(PHP_VERSION, '5.4', '<') === true) {
    die('Please update your PHP version, Requires PHP v5.4 or Above! \n');
}

defined('DEVELOPMENT_ENVIRONMENT') or define('DEVELOPMENT_ENVIRONMENT', true);

if (DEVELOPMENT_ENVIRONMENT === true) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
}

date_default_timezone_set('UTC');

require '/../app/bootstrap/Autoloader.php';

Autoloader::map([
    __DIR__ . '/../app/helpers',
    __DIR__ . '/../app/core',
]);

require '/../app/bootstrap/App.php';
require '/../app/bootstrap/Routes.php';

$App = new App();
