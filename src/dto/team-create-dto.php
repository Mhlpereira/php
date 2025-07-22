<?php

namespace App\Dto;

use App\Enums\TeamStatus;


class TeamCreateDto{

    private string $courseId;
    private string $title;
    private string $description;
    private int $maxStudents;
    private TeamStatus $status;
    private \DateTime $startingDate;
    private \DateTime $endingDate;

    public function __construct(
        string $courseId,
        string $title,
        string $description,
        int $maxStudents,
        TeamStatus $status,
        \DateTime $startingDate,
        \DateTime $endingDate
    ) {
        if (empty($title)) {
            throw new \InvalidArgumentException('Title is required');
        }
        if($endingDate < $startingDate) {
            throw new \InvalidArgumentException('Ending date must be after starting date');
        }
        if($maxStudents <= 0) {
            throw new \InvalidArgumentException('Max students must be greater than zero');
        }
        if(empty($courseId)) {
            throw new \InvalidArgumentException('Course ID is required');
        }
        if(empty($status)) {
            throw new \InvalidArgumentException('Status is required');
        }
        $this->courseId = $courseId;
        $this->title = $title;
        $this->description = $description;
        $this->maxStudents = $maxStudents;
        $this->status = $status;
        $this->startingDate = $startingDate;
        $this->endingDate = $endingDate;
    }

}