<?php

class Viewa
{
    public static function make($file, $data)
    {
        require __DIR__ . '/../views/' . $file . '.php';
    }
}
