<?php
namespace App\Providers;

class Cookie
{
    public static function get($name)
    {
        return ($_COOKIE[$name]) ? $_COOKIE[$name] : false;
    }

    public static function set($name, $value, $expiry)
    {
        if (setcookie($name, $value, time() + $expiry, '/'))
        {
            return true;
        }

        return false;
    }

    public static function delete($name)
    {
        self::set($name, '', time() - 1);
    }
}
