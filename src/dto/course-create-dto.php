<?php

namespace App\Dto;

use App\Enums\CourseCategory;

class CourseCreateDto {

    private string $title;
    private string $description;
    private CourseCategory $category;
    private string $imageUrl;

    public function __construct(string $title, string $description, CourseCategory $category, string $imageUrl) {
        if (empty($title)) {
            throw new \InvalidArgumentException('Title is required');
        }
        if (empty($category)) {
            throw new \InvalidArgumentException('Category is required');
        }
        if (empty($imageUrl)) {
            throw new \InvalidArgumentException('Image URL is required');
        }
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->imageUrl = $imageUrl;
    }

}