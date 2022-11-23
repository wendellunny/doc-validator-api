<?php 

namespace App\Routes;

use App\Controllers\CpfController;
use App\Models\Cpf;

class Routes
{
    private $cpfModel;
    
    public function get(){
        $this->instanceClasses();

        return [
            '/cpf/formatter' => [
                'controller_class' => CpfController::class,
                'method' => 'formatCpf',
                'dependency_injection' => [
                    'cpf_model' => $this->cpfModel
                ]
            ]
        ];
    }

    private function instanceClasses(){
        $this->cpfModel = New Cpf();
    }
}