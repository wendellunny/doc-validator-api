<?php

namespace App\Factories\Models;

use App\Api\FactoryInterface;
use App\Models\Cnpj;

class CnpjFactory implements FactoryInterface
{

    public function create(array $constructor = []): mixed
    {
        return new Cnpj(...$constructor);
    }
}
