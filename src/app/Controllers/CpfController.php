<?php
namespace App\Controllers;
class CpfController
{
    public function formatCpf(){
        $cpf = $_POST['cpf'];
        $cpfFormated =  preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cpf);

        echo json_encode([
           'original' => $cpf, 
           'formated' => $cpfFormated
        ]);
        
        die();
    }
}