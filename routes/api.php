<?php

use App\General\Route;

Route::post('/api/form/store', ['UserController', 'store']);
Route::post('/api/form/store/{id}', ['UserController', 'store']);
Route::get('/api/form/find/{id}', ['UserController', 'find']);
