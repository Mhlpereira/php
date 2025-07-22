<?php

namespace App\Dto;

use App\Enums\TeamStatus;

class TeamUpdateDto{
    private string $teamId;
    private string $courseId;
    private TeamStatus $status;
    private int $maxStudents;
    private \DateTime $startingDate;
    private \DateTime $endingDate;

    public function __construct(
        string $teamId,
        string $courseId,
        TeamStatus $status,
        int $maxStudents,
        \DateTime $startingDate,
        \DateTime $endingDate
    ) {
        if (empty($teamId)) {
            throw new \InvalidArgumentException('Team ID is required');
        }
        if (empty($courseId)) {
            throw new \InvalidArgumentException('Course ID is required');
        }
        
        $this->teamId = $teamId;
        $this->courseId = $courseId;
        $this->status = $status;
        $this->maxStudents = $maxStudents;
        $this->startingDate = $startingDate;
        $this->endingDate = $endingDate;
    }
}