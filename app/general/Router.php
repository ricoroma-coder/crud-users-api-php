<?php

namespace App\General;

class Router
{
    protected $collection;
    protected $dispacher;

    public function __construct()
    {
        $this->collection = new RouteCollection();
        $this->dispacher = new Dispacher();
    }

    public function get($pattern, $callback)
    {
        $this->collection->add('get', $pattern, $callback);
        return $this;
    }

    public function post($pattern, $callback)
    {
        $this->collection->add('post', $pattern, $callback);
        return $this;
    }
}
