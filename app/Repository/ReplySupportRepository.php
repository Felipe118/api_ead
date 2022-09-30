<?php

namespace App\Repository;

use App\Models\ReplySupport;
use App\Repository\Traits\RepositoryTrait;

class ReplySupportRepository
{
    use RepositoryTrait;
    protected $entity;
    
    public function __construct(ReplySupport $model)
    {
        $this->entity = $model;
    }
     
    public function createReplyToSupport(array $date) 
    {
        $user = $this->getUserAuth();
        
        return $this->entity
        ->create([
            'support_id' => $date['support'], 
            'description' => $date['description'],
            'user_id' => $user->id, 
        ]);
    }
    

   
}