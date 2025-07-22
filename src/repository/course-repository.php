<?php 

namespace App\Repository;

use App\Db\ConnectionPool;

class CourseRepository {

    private $pdo;

    public function __construct(){
        $this->pdo = ConnectionPool::getInstance();
    }

    public function createCourse($data){
        try{
            $stmt = $this->pdo->prepare(
                "INSERT INTO courses (title, description, category, image_url) 
                VALUES (:title, :description, :category, :image_url)"
            );
            $stmt->bindParam(':title', $data->getTitle());
            $stmt->bindParam(':description', $data->getDescription());
            $stmt->bindParam(':category', $data->getCategory()->value);
            $imageUrl = $data['image_url'] ?? null;
            $stmt->bindParam(':image_url', $imageUrl);

            $stmt->execute();
            return ['status' => 'success', 'message' => 'Course created successfully'];
        } catch (\Exception $e) {
            throw new \Exception('Failed to create course: ' . $e->getMessage());
        }
    }

    public function getAllCourses() {
        $stmt = $this->pdo->prepare("SELECT * FROM courses");
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCourseById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM courses WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateCourse($id, $data) {
        $stmt = $this->pdo->prepare(
            "UPDATE courses SET title = :title, description = :description, 
            category = :category, image_url = :image_url WHERE id = :id"
        );
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $data->getTitle());
        $stmt->bindParam(':description', $data->getDescription());
        $stmt->bindParam(':category', $data->getCategory()->value);
        $imageUrl = $data['image_url'] ?? null;
        $stmt->bindParam(':image_url', $imageUrl);

        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Course updated successfully'];
        } else {
            throw new \Exception('Failed to update course');
        }
    }

    public function deleteCourse($id) {
        $stmt = $this->pdo->prepare("DELETE FROM courses WHERE id = :id");
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Course deleted successfully'];
        } else {
            throw new \Exception('Failed to delete course');
        }
    }
}