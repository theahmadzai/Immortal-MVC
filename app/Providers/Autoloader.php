<?php
namespace App\Providers;

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
            $files = glob(APP_ROOT . $dir . '/*.php');

            foreach ($files as $file)
            {
                self::loadFile($file);
            }
        }
    }

    private static function loadClasses()
    {
        spl_autoload_register(function ($class)
        {
            foreach (self::$classes as $dir)
            {
                self::loadFile(APP_ROOT . $dir . '/' . $class . '.php');
            }
        });
    }

    private static function loadFile($path)
    {
        $file = realpath($path);

        if (file_exists($file) && is_readable($file))
        {
            require_once $file;
        }
    }
}
