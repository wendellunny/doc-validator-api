<?php

namespace App\Factories\Controllers\Cpf;

use App\Api\FactoryInterface;
use App\Controllers\Cpf\CpfFormatter;

class CpfFormatterFactory implements FactoryInterface
{
    public function create(array $constructor = []): mixed
    {
        return new CpfFormatter(...$constructor);
    }
}