<?php 

namespace App\Routes;

use App\Controllers\CpfController;

class Routes
{
    public function get(){
        return [
            '/cpf/formatter' => [
                'controller_class' => CpfController::class,
                'method' => 'formatCpf'
            ]
        ];
    }
}