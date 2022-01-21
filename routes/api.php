<?php

use App\General\Route;

Route::post('/api/form/store', ['UserController', 'store']);
Route::post('/api/form/store/{id}', ['UserController', 'store']);
Route::get('/api/form/find/{id}', ['UserController', 'find']);
Route::post('/api/form/delete', ['UserController', 'delete']);

Route::get('/api/find/states', ['UserController', 'specialFilter']);
Route::get('/api/find/states/{id}', ['UserController', 'specialFilter']);
Route::get('/api/find/cities', ['UserController', 'specialFilter']);
Route::get('/api/find/cities/{id}', ['UserController', 'specialFilter']);
Route::get('/api/find/addresses', ['UserController', 'specialFilter']);
Route::get('/api/find/addresses/{id}', ['UserController', 'specialFilter']);

Route::post('/api/find/totalByState', ['UserController', 'calculateTotal']);
Route::post('/api/find/totalByState/data', ['UserController', 'calculateTotal']);
Route::post('/api/find/totalByCity', ['UserController', 'calculateTotal']);
Route::post('/api/find/totalByCity/data', ['UserController', 'calculateTotal']);
