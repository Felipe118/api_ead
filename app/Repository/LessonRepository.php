<?php

namespace App\Repository;

use App\Models\Lesson;
use App\Repository\Traits\RepositoryTrait;

class LessonRepository
{
    use RepositoryTrait;
    protected $entity;
    
    public function __construct(Lesson $lesson)
    {
        $this->entity = $lesson;
    }

    public function getLessonsByModuleId(string $moduleId)
    {
        return $this->entity->where('module_id',$moduleId)->get();
    }
  

    public function getLesson(string $id) : Lesson
    {
        return $this->entity->findOrFail($id);
    }

    public function markLessonViewed(string $lessonId)
    {
        $user = $this->getUserAuth();

        $view = $user->views()->where('lesson_id',$lessonId)->first();

        if($view){
           return $view->update(['quantity'=>$view->quantity + 1]);
        }
        
        return $user->views()->create([
            'lesson_id' => $lessonId,
            'quantity' => 1
        ]);
    }
}