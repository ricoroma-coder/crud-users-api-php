<?php

namespace App\General;

class Request
{
    protected $base;
    protected $uri;
    protected $method;
    protected $protocol;
    protected $data = [];
    protected $parameters = [];
    protected $query = [];

    public function __construct($base = '')
    {
        if (empty($base))
        {
            $this->base = $_SERVER['REQUEST_URI'];
            $this->method = strtolower($_SERVER['REQUEST_METHOD']);
            $this->protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';

            if (isset($_REQUEST['uri']))
                $this->uri = $_REQUEST['uri'];
            else if ($this->base == '/')
                $this->uri = '/';
            else
                $this->uri = substr($this->base, 1);

            $this->setData();
        }
        else
            $this->newRequestByUri($base);
    }

    protected function setData()
    {
        if ($this->method == 'get')
            $this->query = $_GET;
        else
        {
            try
            {
                $this->data = json_decode(file_get_contents('php://input'));
            }
            catch (\Exception $e)
            {
                response()->json(['success' => false, 'message' => 'Input must be JSON'], 400);
            }
        }
    }

    public function newRequestByUri($base)
    {
        $this->base = $base;
        $this->method = 'get';
        $this->protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
        $this->uri = $base != '/' ? substr($base, 1) : $base;
        $this->setData();
    }

    public function setParameters($values)
    {
        if (!is_bool($values))
        {
            $base = explode('/', $this->base);
            foreach ($values as $parameter => $value)
            {
                if (isset($base[$value]))
                    $this->parameters[$parameter] = $base[$value];
            }
        }
    }

    public function base()
    {
        return $this->base;
    }

    public function uri()
    {
        return $this->uri;
    }

    public function method()
    {
        return $this->method;
    }

    public function all()
    {
        return $this->data;
    }

    public function params()
    {
        return $this->parameters;
    }
}
