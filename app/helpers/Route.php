<?php

class Route
{
    private static $routes = [];

    public static function get($key = null)
    {
        if (!$key)
        {
            return self::$routes;
        }

        return isset(self::$routes[$key]) ? self::$routes[$key] : false;
    }

    public static function set($key, $value)
    {
        self::$routes[$key] = $value;
    }
}
