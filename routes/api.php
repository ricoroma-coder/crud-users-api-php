<?php

use App\General\Route;

Route::post('/api/form/store', ['UserController', 'store']);
Route::post('/api/form/store/{id}', ['UserController', 'store']);
Route::get('/api/form/find/{id}', ['UserController', 'find']);
Route::post('/api/form/delete', ['UserController', 'delete']);

Route::get('/api/find/states', ['UserController', 'specialFilter']);
Route::get('/api/find/cities', ['UserController', 'specialFilter']);
Route::get('/api/find/addresses', ['UserController', 'specialFilter']);
