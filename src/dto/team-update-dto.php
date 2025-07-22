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
}