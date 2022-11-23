<?php 

namespace App\Routes;

use App\Controllers\TestController;

class Routes
{
    public function get(){
        return [
            '/teste' => [
                'controller_class' => TestController::class,
                'method' => 'teste'
            ],
            '/opa' =>[
                'controller_class' => ''
            ]
        ];
    }
}