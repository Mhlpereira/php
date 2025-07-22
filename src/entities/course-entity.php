<?php
namespace App\Entities;
use App\Enums\CourseCategory;
class Course{

    private string $id;
    private string $title;
    private string $description;
    private CourseCategory $category;
    private string $imageUrl;
    private array $turmas =[];

    public function __construct(string $title, string $description, CourseCategory $category, string $imageUrl)
    {   
        $this->id = Uuid::uuid4()->toString();
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->imageUrl = $imageUrl;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCategory(): CourseCategory
    {
        return $this->category;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setCategory(CourseCategory $category): void
    {
        $this->category = $category;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    public function addTeam(Team $team): void
    {
        $this->turmas[] = $team;
    }

    public function getTeams(): array
    {
        return $this->turmas;
    }
}