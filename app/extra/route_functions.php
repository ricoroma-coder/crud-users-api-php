<?php

use App\General\Request;
use App\General\Route;
use App\General\Response;
use App\General\Database;

function resolve($base = '')
{
    $request = new Request($base);
    return Route::resolve($request);
}

function response()
{
    return new Response();
}

function database()
{
    new Database();
}

function dotenv()
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../");
    $dotenv->load();
}
