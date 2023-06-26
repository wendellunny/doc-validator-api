<?php

namespace App\Factories\Controllers\Cpf;

use App\Api\FactoryInterface;
use App\Controllers\Cpf\CpfValidator;

class CpfValidatorFactory implements FactoryInterface
{

    public function create(array $constructor = []): mixed
    {
        return new CpfValidator(...$constructor);
    }
}