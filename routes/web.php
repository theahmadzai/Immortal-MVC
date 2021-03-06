<?php
use App\Providers\Route;
use App\Providers\View;

Route::set('/', 'Home@index');

Route::set('users', 'Users@index');

Route::set('user', 'User@index');

Route::set('user/:name', 'User@name');

Route::set('comments/:id/:?name', 'Comments@index');

Route::set('test/:id/:?name', function ($id = 13, $name = 'javed')
{
    $data = ['id' => $id, 'name' => $name];

    return View::make('index.twig', $data);
});
