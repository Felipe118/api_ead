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
        return $this->entity->with('lessons.views')->where('course_id',$courseId)->get();
    }
}