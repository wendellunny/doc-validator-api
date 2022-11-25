<?php 

namespace App\Routes;

use App\Controllers\CnpjController;
use App\Controllers\CpfController;
use App\Models\Cnpj;
use App\Models\Cpf;

class Routes
{
    /**
     * Cpf Model
     *
     * @var Cpf
     */
    private Cpf $cpfModel;

    private Cnpj $cnpjModel;

    /**
     * Routes
     *
     * @var array
     */
    private array $routes;
    
    /**
     * Get all routes data
     *
     * @return array
     */
    public function get(): array
    {
        $this->instanceClasses();
        $this->register([
            '/cpf/formatter' => [
                'http_method' => 'POST',
                'controller_class' => CpfController::class,
                'method' => 'formatCpf',
                'dependency_injection' => [
                    'cpf_model' => $this->cpfModel
                ]
            ],

            '/cpf/validator' => [
                'http_method' => 'POST',
                'controller_class' => CpfController::class,
                'method' => 'validateCpf',
                'dependency_injection' => [
                    'cpf_model' => $this->cpfModel
                ]
            ],

            '/cnpj/formatter' => [
                'http_method' => 'POST',
                'controller_class' => CnpjController::class,
                'method' => 'formatCnpj',
                'dependency_injection' => [
                    'cnpj_model' => $this->cnpjModel
                ]
            ],

            '/cnpj/validator' => [
                'http_method' => 'POST',
                'controller_class' => CnpjController::class,
                'method' => 'validateCnpj',
                'dependency_injection' => [
                    'cnpj_model' => $this->cnpjModel
                ]
            ]
        ]);

        return $this->routes;
    }
    
    /**
     * Register Routes
     *
     * @param array $routes
     * @return void
     */
    private function register(array $routes): void
    {
        $this->routes = $routes;
    }

    /**
     * Instance Classes
     *
     * @return void
     */
    private function instanceClasses(): void
    {
        $this->cpfModel = New Cpf();
        $this->cnpjModel = New Cnpj();
    }
}