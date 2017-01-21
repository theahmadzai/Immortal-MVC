<?php
namespace App\Providers;

class View
{
    public static function make($path, $data = [])
    {
        ob_start();
        ob_implicit_flush(0);

        if (!empty($path))
        {
            require __DIR__ . '/../../resources/views/' . $path . '.php';
        }

        return ob_get_clean();
    }
}
