<?php

namespace App\Repository;

use App\Models\Support;

class SupportRepository
{
    protected $entity;
    
    public function __construct(Support $support)
    {
        $this->entity = $support;
    }
    
    public function getModulesCourseById(string $courseId)
    {
        return $this->entity->where('course_id',$courseId)->get();
    }
}