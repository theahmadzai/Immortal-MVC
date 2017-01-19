<?php
use Model\User as UM;

class User extends Controller
{
    public function index()
    {
        return View::make('index', 'welcome');
    }

    public function name($name)
    {
        $sum = new UM\User();
        $sum = $sum->get();

        return View::make('index', $sum);
    }
}
