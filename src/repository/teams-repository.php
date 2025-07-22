<?php 

namespace App\Repository;

use App\Db\ConnectionPool;

class TeamsRepository {
    
    private $pdo;

    public function __construct(){
        $this->pdo = ConnectionPool::getInstance();
    }

    public function createTeam($data) {
        $stmt = $this->pdo->prepare("INSERT INTO teams (name, course_id) VALUES (:name, :course_id)");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':course_id', $data['course_id']);
        
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Team created successfully'];
        } else {
            throw new \Exception('Failed to create team');
        }
    }

    public function addStudent($student) {
        $stmt = $this->pdo->prepare("INSERT INTO team_students (team_id, student_id) VALUES (:team_id, :student_id)");
        $stmt->bindParam(':team_id', $student['team_id']);
        $stmt->bindParam(':student_id', $student['student_id']);
        
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Student added to team successfully'];
        } else {
            throw new \Exception('Failed to add student to team');
        }
    }

    public function getTeamById($teamId) {
        try{
        $stmt = $this->pdo->prepare("SELECT * FROM teams WHERE id = :id");
        $stmt->bindParam(':id', $teamId);
        $stmt->execute();
        
        return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception('Failed to retrieve team: ' . $e->getMessage());
        }
    }
}