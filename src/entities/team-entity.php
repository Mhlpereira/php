<?php
namespace App\Entities;

class Team{

    private string $id;
    private Course $course;
    private string $title;
    private string $description;
    private int $maxStudents;
    private TeamStatus $status;
    private \DateTime $startingDate;
    private \DateTime $endingDate;
    private array $students = [];

    public function __construct(Course $course, string $title, string $description, int $maxStudents, TeamStatus $status, \DateTime $startingDate, \DateTime $endingDate)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->course = $course;
        $this->title = $title;
        $this->description = $description;
        $this->maxStudents = $maxStudents;
        $this->status = $status;
        $this->startingDate = $startingDate;
        $this->endingDate = $endingDate;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    public function getDescription(): string
    {
        return $this->description;
    }

    public function getMaxStudents(): int
    {
        return $this->maxStudents;
    }

    public function getStatus(): TeamStatus
    {
        return $this->status;
    }

    public function getStartingDate(): \DateTime
    {
        return $this->startingDate;
    }

    public function getEndingDate(): \DateTime
    {
        return $this->endingDate;
    }

    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setMaxStudents(int $maxStudents): void
    {
        $this->maxStudents = $maxStudents;
    }

    public function setStatus(TeamStatus $status): void
    {
        $this->status = $status;
    }

    public function setStartingDate(\DateTime $startingDate): void
    {
        $this->startingDate = $startingDate;
    }

    public function setEndingDate(\DateTime $endingDate): void
    {
        $this->endingDate = $endingDate;
    }

    public function addStudent(User $student): void
    {
        if (count($this->students) < $this->maxStudents) {
            $this->students[] = $student;
        } else {
            throw new \Exception("Maximum number of students reached.");
        }
    }


}