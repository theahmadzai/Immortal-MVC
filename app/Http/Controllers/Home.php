<?php
namespace App\Http\Controllers;

use App\Providers\View;

class Home extends Controller
{
    public function index()
    {
        View::make('index.twig', ['name' => 'Javed']);
    }
}
