<?php
namespace App\Controllers\Cnpj;

use App\Api\Controllers\ControllerInterface;
use App\Api\Services\HttpHandler\ResponseInterface;
use App\Models\Cnpj;
use App\Services\HttpHandler\Response;

class CnpjValidator implements ControllerInterface
{
    public function __construct(private Response $response, private Cnpj $cnpj)
    {}

    public function execute(array $params): ResponseInterface
    {

        $cnpj = strval($params['cnpj']);
        $this->cnpj->setUnformattedCnpj($cnpj);

        return $this->cnpj->validateCnpj()
            ? $this->response->json([
                'isValid' => true,
                'message' => 'Este CNPJ é válido',
                'cnpj' => $this->cnpj->getCnpj()
            ])
            : $this->response->json([
                'isValid' => false,
                'message' => 'Este CNPJ é inválido',
                'cnpj' => $this->cnpj->getCnpj()
            ]);
    }
}