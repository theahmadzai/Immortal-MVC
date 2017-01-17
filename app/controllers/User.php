<?php

class User extends Controller
{
    public function index()
    {
        return View::make('index', 'welcome');
    }

    public function name($name)
    {
        return View::make('index', $name);
    }
}
