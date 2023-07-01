<?php

namespace App\Services\Database;

class Mysql extends Database
{
    public function getConnection(): string
    {
        return 'mysql:host=localhost;dbname=meuBancoDeDados';
    }
}