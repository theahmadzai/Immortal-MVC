<?php
namespace App\Providers;

class View
{
    public static function make($path, $data = [])
    {
        return ['path' => $path, 'data' => $data];
    }
}
