<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\LessonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\SupportController;
use App\Http\Resources\ReplySupportResource;

/**
 * @Auth
 */
Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum'); 

/**
 * Reset Password
 */

Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLinkEmail'])->middleware('guest');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest');

Route::middleware(['auth:sanctum'])->group(function(){

    Route::get('/courses',[CourseController::class, 'index']);
    Route::get('/courses/{id}',[CourseController::class, 'show']);
    
    Route::get('courses/{id}/modules',[ModuleController::class, 'index']);
    
    Route::get('modules/{id}/lessons',[LessonController::class, 'index']);
    Route::get('lesson/{id}',[LessonController::class, 'show']);
    Route::post('lesson/viewed',[LessonController::class, 'viewed']);
    
    Route::get('/supports',[SupportController::class, 'index']);
    Route::post('/supports',[SupportController::class, 'store']);
    Route::get('/my-supports',[SupportController::class, 'mySupport']);
    
    Route::post('/replies',[ReplySupportResource::class, 'createReply']);
});





// Route::get('/',function(){ 
//     return response()->json(['message'=>'Welcome to the API']); 
// });