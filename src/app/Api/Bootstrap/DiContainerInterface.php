<?php

namespace App\Api\Bootstrap;

interface DiContainerInterface
{
    public function create(string $class): mixed;
}