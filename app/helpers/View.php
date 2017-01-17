<?php

class View
{
    public static function make($path, $data = [])
    {
        return func_get_args();
    }
}
