<?php

class Comments
{
    public function index($name, $fname)
    {
        return View::make('user', compact('name', 'fname'));
    }
}
