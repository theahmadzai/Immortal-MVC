<?php

class Autoloader
{
    private static $files   = [];
    private static $classes = [];

    public static function map(array $map = [])
    {
        if (isset($map))
        {
            if (array_key_exists('classes', $map) && !empty($map['classes']))
            {
                self::$classes = $map['classes'];
                self::loadClasses();
            }
            if (array_key_exists('files', $map) && !empty($map['files']))
            {
                self::$files = $map['files'];
                self::loadFiles();
            }
        }
    }

    private static function loadFiles()
    {
        foreach (self::$files as $dir)
        {
            $files = array_slice(scandir(APP . $dir), 2);

            foreach ($files as $file)
            {
                $file = realpath(APP . $dir . DIRECTORY_SEPARATOR . $file);

                if (file_exists($file) && is_readable($file))
                {
                    require_once $file;
                }
            }
        }
    }

    private static function loadClasses()
    {
        spl_autoload_register(function ($class)
        {
            foreach (self::$classes as $dir)
            {
                $file = realpath(APP . $dir . DIRECTORY_SEPARATOR . $class . '.php');

                if (file_exists($file) && is_readable($file))
                {
                    require_once $file;
                }
            }
        });
    }
}
