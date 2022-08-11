<?php

namespace App\Repository;

use App\Models\Support;
use App\Models\User;

class SupportRepository
{
    protected $entity;
    
    public function __construct(Support $support)
    {
        $this->entity = $support;
    }
    
    public function getSupports(array $filters = [])
    {
        return $this->getUserAuth()->supports()
        ->where(function($query) use($filters) {
            if(isset($filters['lesson'])) {
                $query->where('lesson', $filters['lesson']);
            }

            if(isset($filters['status'])) {
                $query->where('status', $filters['status']);
            }

            if(isset($filters['filter'])) {
                $query->where('description','LIKE' , "%{$filters}%");
            }
        })->get();
    }

    public function getUserAuth() :User
    {
        return User::first();
    }
}