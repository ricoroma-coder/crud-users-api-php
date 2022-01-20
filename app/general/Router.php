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
}
