<?php

namespace App\Repository;

use App\Models\Course;

class CourseRepository
{
    protected $entity;
    
    public function __construct(Course $course) 
    {
        $this->entity = $course;
    }

    public function getAllCourses()
    {
        return $this->entity->with('modules.lessons')->get();
    }

    public function getCourse(string $id)
    {
        return $this->entity->with('modules.lessons')->findOrFail($id);
    }
}