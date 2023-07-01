<?php

namespace App\Services\Database;

use App\Api\Services\Database\DatabaseInterface;
use App\Factories\Services\Database\PDOFactory;

abstract class Database implements DatabaseInterface
{

    public function __construct(private PDOFactory $PDOFactory)
    {

    }

    public function connect(): void
    {
        $connection = $this->getConnection();
        $this->PDOFactory->create([$this->getConnection()]);
    }
}