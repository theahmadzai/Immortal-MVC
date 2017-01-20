<?php
namespace App\Providers;

class Session
{
    public static function get($name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function delete($name)
    {
        if (!empty($name))
        {
            if (!self::get($name) === false)
            {
                unset($_SESSION[$name]);
            }

            return false;
        }
        session_destroy();
    }
}
