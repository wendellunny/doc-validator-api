<?php

namespace App\Bootstrap;

use App\Api\Bootstrap\DiContainerInterface;

class DiContainer implements DiContainerInterface
{

    public function create(string $class): mixed
    {
        $parameters = $this->getConstructorDependencies($class);
        return  new $class(...$parameters);
    }

    private function getConstructorDependencies(string $className): array
    {
        $parameters = [];
        $reflection =  new \ReflectionClass($className);
        $constructor = $reflection->getConstructor();

        if (empty($constructor)) {
            return [];
        }

        foreach ($constructor->getParameters() as $parameter) {
            $class = $parameter->getClass()->name;
            $dependecies = $this->getConstructorDependencies($class);
            $parameters[$parameter->name] = new $class(...$dependecies);
        }

        return $parameters;
    }


}