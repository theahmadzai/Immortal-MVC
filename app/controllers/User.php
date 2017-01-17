<?php

class User extends Controller
{
    public function index()
    {
        return View::make('user', 'welcome');
    }

    public function name($name)
    {
        return View::make('user', $name);
    }
}
