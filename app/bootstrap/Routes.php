<?php

Route::set('/', 'Home@index');

Route::set('users', 'Users@index');

Route::set('user', 'User@index');

Route::set('user/:name', 'User@name');

Route::set('comments/:name/:?fname', 'Comments@index');
