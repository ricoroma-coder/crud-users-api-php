<?php

namespace App\General;

use App\General\Router;

class Route
{
    protected static $router;

    protected static function getRouter()
    {
        if(empty(self::$router))
            self::$router = new Router();

        return self::$router;
    }

    public static function post($pattern, $callback)
    {
        return self::getRouter()->post($pattern, $callback);
    }

    public static function get($pattern, $callback)
    {
        return self::getRouter()->get($pattern, $callback);
    }

    public static function put($pattern, $callback)
    {
        return self::post($pattern, $callback);
    }

    public static function delete($pattern, $callback)
    {
        return self::post($pattern, $callback);
    }
}
