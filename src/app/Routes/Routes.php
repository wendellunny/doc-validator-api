<?php 

namespace App\Routes;

use App\Controllers\CpfController;
use App\Models\Cpf;

class Routes
{
    /**
     * Cpf Model
     *
     * @var Cpf
     */
    private Cpf $cpfModel;

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
    }
}