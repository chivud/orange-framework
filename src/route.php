<?php

use Core\Route\Route;

Route::get('/', 'Example@index');
Route::get('/users', 'Example@index');
Route::get('/customers', 'Example@index');
Route::post('/customers/create/', 'Example@index');