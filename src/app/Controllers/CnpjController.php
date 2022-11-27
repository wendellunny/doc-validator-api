<?php

namespace App\Controllers;

use App\Models\Cnpj;

class CnpjController
{
    private Cnpj $cnpjModel;

    public function __construct(array $dependencyInjection)
    {
        $this->cnpjModel = $dependencyInjection['cnpj_model'];
    }

    public function formatCnpj(array $request)
    {
        $cnpj = strval($request['cnpj']);
        $this->cnpjModel->setUnformattedCnpj($cnpj);

        return json($this->cnpjModel->getCnpj());
    }

    public function validateCnpj(array $request): string
    {
        $cnpj = strval($request['cnpj']);
        $this->cnpjModel->setUnformattedCnpj($cnpj);
        
        return $this->cnpjModel->validateCnpj()
        ? json([ 
            'isValid' => true, 
            'message' => 'Este CNPJ é válido', 
            'cnpj' => $this->cnpjModel->getCnpj()
        ])
        : json([
            'isValid' => false,
            'message' => 'Este CNPJ é inválido', 
            'cnpj' => $this->cnpjModel->getCnpj()
        ]);
    }
}