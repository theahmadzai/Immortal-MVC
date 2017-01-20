<?php
namespace App\Providers;

class Config
{
    public static function get($item)
    {
        $config = parse_ini_file('/../config/config.ini', false);

        return $config[$item];
    }
}
