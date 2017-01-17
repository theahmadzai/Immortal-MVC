<?php

class User extends Controller
{
    public function index()
    {
        return View::make('user', 'welcome');
    }

    public function name($params = [])
    {
        return View::make('user', $params);
    }
}
