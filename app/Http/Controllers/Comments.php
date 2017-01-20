<?php
namespace App\Http\Controllers;

use App\Providers\View;

class Comments extends Controller
{
    public function index($name, $fname)
    {
        return View::make('index', compact('name', 'fname'));
    }
}
