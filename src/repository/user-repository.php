<?php

namespace App\Repository;

use App\Db\ConnectionPool;

class UserRepository {

    private $pdo;

    public function __construct(){
        $this->pdo = ConnectionPool::getInstance();
    }

    
}