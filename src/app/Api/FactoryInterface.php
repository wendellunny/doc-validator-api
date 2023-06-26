<?php

namespace App\Api;

interface FactoryInterface
{
    public function create(array $constructor = []): mixed;
}