<?php

namespace App\Repository;

use App\Models\Support;
use App\Repository\Traits\RepositoryTrait;

class SupportRepository
{
    use RepositoryTrait;
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
                $query->where('lesson_id', $filters['lesson']);
            }

            if(isset($filters['status'])) {
                $query->where('status', $filters['status']);
            }

            if(isset($filters['filter'])) {
                $query->where('description','LIKE' , "%{$filters}%");
            }
        })->get();
    }

    public function createNewSupport(array $data) :Support
    {
        $support = $this->getUserAuth()->supports()->create([
            'lesson_id' => $data['lesson'],
            'status' => $data['status'],
            'description' => $data['description'],
        ]);

        return $support;
    }

    public function createReplyToSupportId(string $supportId, array $date)
    {
        $user = $this->getUserAuth();
        return $this->getSupport($supportId)
        ->replies()
        ->create([
            'user_id' => $user->id,
            'description' => $date['description'],
        ]);
    }
    public function getSupport(string $id)
    {
        return $this->entity->findOrfail($id);
    }

   
}