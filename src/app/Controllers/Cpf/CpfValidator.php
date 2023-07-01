<?php

namespace App\Controllers\Cpf;

use App\Api\Controllers\ControllerInterface;
use App\Api\Services\HttpHandler\ResponseInterface;
use App\Models\Cpf;
use App\Services\HttpHandler\Response;

class CpfValidator implements ControllerInterface
{
    public function __construct(private Response $response, private Cpf $cpf)
    {
    }

    public function execute(array $params): ResponseInterface
    {
        $cpf = strval($params['cpf']);
        $this->cpf->setUnformattedCpf($cpf);

        return $this->cpf->validateCpf()
            ? $this->response->json([
                'isValid' => true,
                'message' => 'Este CPF é válido',
                'cpf' => $this->cpf->getCpf()
            ])
            : $this->response->json([
                'isValid' => false,
                'message' => 'Este CPF é inválido',
                'cpf' => $this->cpf->getCpf()
            ]);
    }
}