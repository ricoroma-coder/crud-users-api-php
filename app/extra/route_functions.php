<?php

use App\General\Request;
use App\General\Route;

function resolve($base = '')
{
    $request = new Request($base);
    return Route::resolve($request);
}
