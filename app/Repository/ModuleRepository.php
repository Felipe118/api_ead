<?php

namespace App\Repository;

use App\Models\Module;

class ModuleRepository
{
    protected $entity;
    
    public function __construct(Module $module)
    {
        $this->entity = $module;
    }
    
    public function getModulesCourseById(string $courseId)
    {
        return $this->entity->where('course_id',$courseId)->get();
    }
}