<?php

namespace App\General;

use App\General\Response;

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

    public function resolve($request)
    {
        $route = $this->find($request->method(), $request->uri());
        if($route)
            return $this->dispach($route, $request);

        $this->routeNotFound($request->uri());
    }

    public function find($request_type, $pattern)
    {
        return $this->collection->where($request_type, $pattern);
    }

    protected function dispach($route, $data = [])
    {
        return $this->dispacher->dispach($route->callback, $data);
    }

    protected function routeNotFound($data)
    {
        response()->json(['success' => false, 'message' => "Path '/{$data}' not found"], 404);
    }
}
