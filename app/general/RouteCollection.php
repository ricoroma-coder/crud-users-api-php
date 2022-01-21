<?php

namespace App\General;

class RouteCollection
{
    protected $routes_post = [];
    protected $routes_get = [];
    protected $route_names = [];

    public function add($request_type, $pattern, $callback)
    {
        switch ($request_type)
        {
            case 'post':
            case 'put':
            case 'delete':
                return $this->addPost($pattern, $callback);
            break;
            case 'get':
                return $this->addGet($pattern, $callback);
            break;
            default:
                throw new \Exception('Tipo de requisição não implementado');
            break;
        }
    }

    protected function addPost($pattern, $callback)
    {
        if(is_array($pattern))
        {
            $settings = $this->parsePattern($pattern);
            $pattern = $settings['set'];
        }
        else
            $settings = [];

        $values = $this->toMap($pattern);

        $this->routes_post[$this->definePattern($pattern)] = [
            'callback' => $callback,
            'values' => $values,
            'namespace' => $settings['namespace'] ?? null
        ];

        if(isset($settings['as']))
            $this->route_names[$settings['as']] = $pattern;

        return $this;
    }

    protected function addGet($pattern, $callback)
    {
        if(is_array($pattern))
        {
            $settings = $this->parsePattern($pattern);
            $pattern = $settings['set'];
        }
        else
            $settings = [];

        $values = $this->toMap($pattern);

        $this->routes_get[$this->definePattern($pattern)] = [
            'callback' => $callback,
            'values' => $values,
            'namespace' => $settings['namespace'] ?? null
        ];

        if(isset($settings['as']))
        {
            $this->route_names[$settings['as']] = $pattern;
        }

        return $this;
    }

    protected function parsePattern(array $pattern)
    {
        $result['set'] = $pattern['set'] ?? null;
        $result['as'] = $pattern['as'] ?? null;
        $result['namespace'] = $pattern['namespace'] ?? null;

        return $result;
    }

    protected function toMap($pattern)
    {
        $result = [];
        $needles = ['{', '[', '(', "\\"];
        $pattern = array_filter(explode('/', $pattern));

        foreach($pattern as $key => $element)
        {
            $found = $this->arrayPosition($element, $needles);

            if($found !== false)
            {
                if(substr($element, 0, 1) === '{')
                    $result[preg_filter('/([\{\}])/', '', $element)] = $key;
                else
                {
                    $index = 'value_' . !empty($result) ? count($result) + 1 : 1;
                    $result = array_merge($result, [$index => $key - 1]);
                }
            }
        }

        return count($result) > 0 ? $result : false;
    }

    protected function arrayPosition(string $haystack, array $needles, int $offset = 0)
    {
        $result = false;

        if(strlen($haystack) > 0 && count($needles) > 0)
        {
            foreach($needles as $element)
            {
                $result = strpos($haystack, $element, $offset);

                if($result !== false)
                    break;
            }
        }

        return $result;
    }

    protected function definePattern($pattern)
    {
        $pattern = implode('/', array_filter(explode('/', $pattern)));
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';

        if (preg_match("/\{[A-Za-z0-9\_\-]{1,}\}/", $pattern))
            $pattern = preg_replace(
                "/\{[A-Za-z0-9\_\-]{1,}\}/",
                "[A-Za-z0-9]{1,}",
                $pattern
            );

        return $pattern;
    }

    public function where($request_type, $pattern)
    {
        switch($request_type)
        {
            case 'post':
            case 'put':
            case 'delete':
                return $this->findPost($pattern);
            break;
            case 'get':
                return $this->findGet($pattern);
            break;
            default:
                throw new \Exception('Internal error (unhandled method)');
            break;
        }
    }

    protected function parseUri($uri)
    {
        return implode('/', array_filter(explode('/', $uri)));
    }

    protected function findPost($pattern_sent)
    {
        $pattern_sent = $this->parseUri($pattern_sent);

        foreach($this->routes_post as $pattern => $callback)
        {
            if(preg_match($pattern, $pattern_sent, $pieces))
                return (object) ['callback' => $callback, 'uri' => $pieces];
        }

        return false;
    }

    protected function findGet($pattern_sent)
    {
        $pattern_sent = $this->parseUri($pattern_sent);

        foreach($this->routes_get as $pattern => $callback)
        {
            if(preg_match($pattern, $pattern_sent, $pieces))
                return (object) ['callback' => $callback, 'uri' => $pieces];
        }

        return false;
    }
}
