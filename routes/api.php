<?php

use App\Http\Controllers\Api\LessonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\ModuleController;

Route::get('/courses',[CourseController::class, 'index']);
Route::get('/courses/{id}',[CourseController::class, 'show']);

Route::get('courses/{id}/modules',[ModuleController::class, 'index']);

Route::get('modules/{id}/lessons',[LessonController::class, 'index']);
Route::get('lesson/{id}',[LessonController::class, 'show']);

Route::get('/',function(){ 
    return response()->json(['message'=>'Welcome to the API']);
});