<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreView;
use App\Http\Resources\LessonResource;
use App\Repository\LessonRepository;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $repository;
    
    public function __construct(LessonRepository $lessonRepository)
    {
       $this->repository = $lessonRepository; 
    }

    public function index($moduleId) 
    {
       $lessons = $this->repository->getLessonsByModuleId($moduleId);

       return LessonResource::collection($lessons);
    }

    public function getAllLessons()
    {
     
         $lessons = $this->repository->getAll();
   
         return LessonResource::collection($lessons);
    }

    public function show($id)
    {
       return new LessonResource($this->repository->getLesson($id));
    }

    public function viewed(StoreView $request)
    {
      $this->repository->markLessonViewed($request->lesson_id);

       return response()->json(['succes'=> true]);
    }
}
