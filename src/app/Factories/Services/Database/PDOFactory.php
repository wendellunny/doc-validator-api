<?php

namespace App\Factories\Services\Database;

use App\Factories\Factory;
use App\Services\Database\Database;

class PDOFactory extends Factory
{
    protected string $className = \PDO::class;
}