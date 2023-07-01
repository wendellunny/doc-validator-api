<?php

namespace App\Factories;

use App\Api\FactoryInterface;

abstract class Factory implements FactoryInterface
{
    protected string $className = '';

    public function create(array $constructor = []): mixed
    {
        $class = $this->className;

        return new $class(...$constructor);
    }
}