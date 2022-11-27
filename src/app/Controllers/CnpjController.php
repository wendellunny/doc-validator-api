<?php

namespace App\Controllers;

use App\Models\Cnpj;

class CnpjController
{
    /**
     * Cnpj Model
     *
     * @var Cnpj
     */
    private Cnpj $cnpjModel;

    /**
     * Constructor method
     *
     * @param array $dependencyInjection
     */
    public function __construct(array $dependencyInjection)
    {
        $this->cnpjModel = $dependencyInjection['cnpj_model'];
    }

    /**
     * Format CNPJ controller method
     *
     * @param array $request
     * @return string
     */
    public function formatCnpj(array $request): string
    {
        $cnpj = strval($request['cnpj']);
        $this->cnpjModel->setUnformattedCnpj($cnpj);

        return json($this->cnpjModel->getCnpj());
    }

    /**
     * Validate CNPJ controller method
     *
     * @param array $request
     * @return string
     */
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