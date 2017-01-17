<?php

class Comments
{
    public function index($name, $fname)
    {
        return View::make('index', compact('name', 'fname'));
    }
}
