<?php

namespace App\Controllers\Cpf;

use App\Api\Controllers\ControllerInterface;
use App\Models\Cpf;

class CpfValidator implements ControllerInterface
{
    public function __construct(private Cpf $cpf)
    {
    }

    public function execute(array $params): void
    {
        try {
            $cpf = strval($params['cpf']);
            $this->cpf->setUnformattedCpf($cpf);

            echo $this->cpf->validateCpf()
                ? json([
                    'isValid' => true,
                    'message' => 'Este CPF é válido',
                    'cpf' => $this->cpf->getCpf()
                ])
                : json([
                    'isValid' => false,
                    'message' => 'Este CPF é inválido',
                    'cpf' => $this->cpf->getCpf()
                ]);
        } catch(\Exception $e){
            echo json(['message' => $e->getMessage()], $e->getCode());
        }

        die();
    }
}