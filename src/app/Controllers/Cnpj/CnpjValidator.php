<?php
namespace App\Controllers\Cnpj;

use App\Api\Controllers\ControllerInterface;
use App\Models\Cnpj;

class CnpjValidator implements ControllerInterface
{
    public function __construct(private Cnpj $cnpj)
    {}

    public function execute(array $params): void
    {
        try {
            $cnpj = strval($params['cnpj']);
            $this->cnpj->setUnformattedCnpj($cnpj);

            echo $this->cnpj->validateCnpj()
                ? json([
                    'isValid' => true,
                    'message' => 'Este CNPJ é válido',
                    'cnpj' => $this->cnpj->getCnpj()
                ])
                : json([
                    'isValid' => false,
                    'message' => 'Este CNPJ é inválido',
                    'cnpj' => $this->cnpj->getCnpj()
                ]);
        }catch (\Exception $e) {
            echo json(['message' => $e->getMessage(),], $e->getCode());
        }

        die();
    }
}