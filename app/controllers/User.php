<?php

class User extends Controller
{
    public function index()
    {
        return Viewa::make('user', 'welcome');
    }

    public function name($params = [])
    {
        return Viewa::make('user', compact('aaa', $params));
    }
}
