<?php

use App\General\Request;
use App\General\Route;
use App\General\Response;

function resolve($base = '')
{
    $request = new Request($base);
    return Route::resolve($request);
}

function response()
{
    return new Response();
}
