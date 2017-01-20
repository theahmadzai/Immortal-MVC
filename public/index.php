<?php
define('APP_TIME', microtime(true));
define('APP_ROOT', __DIR__ . '/../app/');
$constants = [
    'DEV_ENV' => true,
];

foreach ($constants as $key => $value)
{
    defined($key) or define($key, $value);
}
function pr($arr)
{
    echo '<pre>', print_r($arr, true), '</pre>';
}

if (version_compare(PHP_VERSION, '5.4', '<') === true)
{
    die('Please update your PHP version, Requires PHP v5.4 or Above! \n');
}

if (DEV_ENV === true)
{
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    register_shutdown_function(function ($startTime)
    {
        echo '<script>console.log("Time: ', number_format((microtime(true) - APP_TIME), 4), ' Seconds");</script>';
    }, APP_TIME);

}
else
{
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
}

date_default_timezone_set('UTC');

require '/../vendor/autoload.php';
require '/../routes/web.php';

$App = new App\Providers\App();
