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
    die('Please update your PHP version, requires PHP v5.4 or Above! \n');
}

$debug = true;
if ($debug) {
    ini_set('display_errors', 1);
    error_reporting(-1);
} else {
    ini_set('display_errors', 0);
}

date_default_timezone_set('UTC');

require '../app/bootstrap/Loader.php';

$loader = new Loader([
    __DIR__ . '/../app/helpers',
    __DIR__ . '/../app/core',
]);

require '../app/bootstrap/App.php';

$App = new App();
