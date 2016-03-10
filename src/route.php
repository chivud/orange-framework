<?php

use Core\Route\Route;

Route::get('/', 'Test@index');
Route::get('users', 'Users@index');
Route::get('/customers', 'Customers@index');
Route::post('/customers/create', 'Customers@create');