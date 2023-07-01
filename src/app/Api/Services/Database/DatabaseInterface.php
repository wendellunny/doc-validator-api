<?php

namespace App\Api\Services\Database;

interface DatabaseInterface
{

    public function connect(): void;

    public function getConnection(): string;
}