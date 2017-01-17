<?php

class View
{
    public static function make($path, $data = [])
    {
        return [$path, $data];
    }
}
