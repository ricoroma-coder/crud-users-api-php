<?php

namespace App\General;

class Dispacher
{
    public function dispach($callback, $params = [], $namespace = "App\\Controllers\\")
    {
        if(is_callable($callback['callback']))
            return call_user_func_array($callback['callback'], array($params));
        elseif (is_array($callback['callback']))
        {
            if(!empty($callback['namespace']))
                $namespace = $callback['namespace'];

            $controller = $namespace.$callback['callback'][0];
            $method = $callback['callback'][1];

            $reflectionClass = new \ReflectionClass($controller);

            $params->setParameters($callback['values']);

            if($reflectionClass->isInstantiable() && $reflectionClass->hasMethod($method))
                return call_user_func_array(array(new $controller, $method), array($params));
            else
                throw new \Exception("Internal error (controller cannot be found)");
        }

        throw new \Exception("Internal error (unhandled method)");
    }
}
