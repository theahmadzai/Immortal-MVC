<?php
namespace App\Http\Controllers;

use App\Http\Models\User as Count;
use App\Providers\View;

class User extends Controller
{
    public function index()
    {
        return View::make('index', 'welcome');
    }

    public function name($name)
    {
        $sum = new Count();
        $sum = $sum->get();

        return View::make('index', $sum);
    }
}
