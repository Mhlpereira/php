<?php

namespace App\Dto;

use App\Enums\CourseCategory;

class CourseUpdateDto {

    private string $id;
    private string $title;
    private string $description;
    private CourseCategory $category;
    private string $imageUrl;

    public function __construct(string $id, string $title, string $description, CourseCategory $category, string $imageUrl) {
        if (empty($id)) {
            throw new \InvalidArgumentException('ID is required');
        }
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->imageUrl = $imageUrl;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getCategory(): CourseCategory {
        return $this->category;
    }

    public function getImageUrl(): string {
        return $this->imageUrl;
    }
}