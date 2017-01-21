<?php
namespace App\Http\Controllers;

use App\Providers\View;

class Home extends Controller
{
    public function index()
    {
        return View::make('index.twig', ['name' => 'Javed']);
    }
}
