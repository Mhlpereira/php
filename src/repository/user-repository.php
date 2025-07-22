<?php

namespace App\Repository;

use App\Db\ConnectionPool;

class UserRepository {

    private $pdo;

    public function __construct(){
        $this->pdo = ConnectionPool::getInstance();
    }

    public function createUser($data) {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $stmt->bindParam(':name', $data->getName());
        $stmt->bindParam(':email', $data->getEmail());
        
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'User created successfully'];
        } else {
            throw new \Exception('Failed to create user');
        }
    }
    
    public function getAllCoursesMatriculated($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM courses WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteUser($name) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE name = :name");
        $stmt->bindParam(':name', $name);
        
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'User deleted successfully'];
        } else {
            throw new \Exception('Failed to delete user');
        }
    }
}