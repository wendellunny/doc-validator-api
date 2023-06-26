<?php

namespace App\Controllers\Cpf;

use App\Api\Controllers\ControllerInterface;
use App\Models\Cpf;

class CpfFormatter implements ControllerInterface
{
    public function __construct(private Cpf $cpf)
    {
    }

    public function execute(array $params): void
    {
        try {
            $cpf = strval($params['cpf']);
            $this->cpf->setUnformattedCpf($cpf);

            echo json($this->cpf->getCpf());
        } catch (\Exception $e) {
            echo json(['message' => $e->getMessage()], $e->getCode());
        }

        die();
    }
}