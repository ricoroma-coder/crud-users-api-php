<?php

namespace App\General;

class Dispacher
{
    public function dispach($callback, $params = [], $namespace = "App\\Controllers\\")
    {
        if(is_callable($callback['callback']))
            return call_user_func_array($callback['callback'], array($params));
        elseif (is_string($callback['callback']))
        {
            if(!!strpos($callback['callback'], '@') !== false)
            {
                if(!empty($callback['namespace']))
                    $namespace = $callback['namespace'];

                $controller = $namespace.$callback['callback'][0];
                $method = $callback['callback'][1];

                $reflectionClass = new \ReflectionClass($controller);

                if($reflectionClass->isInstantiable() && $reflectionClass->hasMethod($method))
                    return call_user_func_array(array(new $controller, $method), array($params));
                else
                    throw new \Exception("Erro ao despachar: controller não pode ser instanciado, ou método não exite");
            }
        }

        throw new \Exception("Erro ao despachar: método não implementado");
    }
}
