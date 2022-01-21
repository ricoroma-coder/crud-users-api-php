<?php

use App\General\Route;

Route::post('/api/form/store', ['UserController', 'store']);
Route::post('/api/form/store/{id}', ['UserController', 'store']);
