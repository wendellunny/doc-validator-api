<?php

namespace App\Factories\Models;

use App\Api\FactoryInterface;
use App\Models\Cpf;

class CpfFactory implements FactoryInterface
{

    public function create(array $constructor = []): mixed
    {
        return new Cpf(...$constructor);
    }
}