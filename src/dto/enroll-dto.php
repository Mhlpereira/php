<?php 

namespace App\Dto;

class EnrollDto {

    private string $userId;
    private string $courseId;
    private string $teamId;

    public function __construct(string $userId, string $courseId, string $teamId) {
        if (empty($userId)) {
            throw new \InvalidArgumentException('User ID is required');
        }
        if (empty($courseId)) {
            throw new \InvalidArgumentException('Course ID is required');
        }
        if (empty($teamId)) {
            throw new \InvalidArgumentException('Team ID is required');
        }
        $this->userId = $userId;
        $this->courseId = $courseId;
        $this->teamId = $teamId;
    }
}