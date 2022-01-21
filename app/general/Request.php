<?php

namespace App\General;

class Request
{
    protected $base;
    protected $uri;
    protected $method;
    protected $protocol;
    protected $data = [];

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
        try
        {
            $this->data = json_decode(file_get_contents('php://input'));
        }
        catch (\Exception $e)
        {
            response()->json(['success' => false, 'message' => 'Input must be JSON'], 400);
        }

        //henrique
//        switch($this->method)
//        {
//            case 'post':
//            case 'put':
//            case 'delete':
//                $this->data = $_POST;
//            break;
//            case 'get':
//                $this->data = $_GET;
//            break;
//        }

//        parse_str(file_get_contents('php://input'), $this->data);
    }

    public function newRequestByUri($base)
    {
        $this->base = $base;
        $this->method = 'get';
        $this->protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
        $this->uri = $base != '/' ? substr($base, 1) : $base;
        $this->setData();
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
}
