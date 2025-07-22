<?php 

namespace App\Service;

use App\Repository\CourseRepository;
use App\Dto\CourseCreateDto;
use App\Service\TeamService;

class CourseService {

    private $courseRepository;

    public function __construct(CourseRepository $courseRepository) {
        $this->courseRepository = $courseRepository;
    }

    public function getAllCourses() {
        try{
            return $this->courseRepository->getAllCourses();
        } catch (\Exception $e) {
            throw new \Exception('Error retrieving courses: ' . $e->getMessage());
        }
    }

    public function getAllAvailableCourses() {
    }

    public function createCourse($data) {
        // Logic to create a new course
    }

    public function updateCourse($id, $data) {
        // Logic to update an existing course
    }

    public function deleteCourse($id) {
        // Logic to delete a course
    }

    public function getCourseById($id) {
        try{
            $course = $this->courseRepository->getCourseById($id);
            if (!$course) {
                throw new \InvalidArgumentException('Course not found');
            }
            return $course;
        } catch (\Exception $e) {
            throw new \Exception('Error retrieving course: ' . $e->getMessage());
        }
    }
}
