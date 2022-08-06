<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupportResource;
use App\Repository\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $repository;
    
    public function __construct(SupportRepository $supportRepository)
    {
       $this->repository = $supportRepository; 
    }

    public function index($courseId)
    {
        $modules = $this->repository->getModulesCourseById($courseId);

        return SupportResource::collection($modules);
    }
}
