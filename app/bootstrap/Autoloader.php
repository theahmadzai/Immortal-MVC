<?php

class Autoloader
{
    private static $dirs = [];

    public static function map(array $dirs = [])
    {
        foreach ($dirs as $dir)
        {
            self::$dirs[] = realpath($dir);
        }
        self::load();
    }

    private static function load()
    {
        spl_autoload_register(function ($class)
        {
            foreach (self::$dirs as $dir)
            {
                $file = $dir . '/' . $class . '.php';
                if (is_readable($file))
                {
                    require_once $file;
                }
            }
        });
    }
}
