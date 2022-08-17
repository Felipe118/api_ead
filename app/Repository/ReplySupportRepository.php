<?php

namespace App\Repository;

use App\Models\ReplySupport;
use App\Repository\Traits\RepositoryTrait;

class ReplySupportRepository
{
    use RepositoryTrait;
    protected $entity;
    
    public function __construct(ReplySupport $support)
    {
        $this->entity = $support;
    }
    
    

    public function createReplyToSupport(array $date)
    {
        $user = $this->getUserAuth();
        
        $this->enity
        ->create([
            'support_id' => $date['support'],
            'user_id' => $user->id,
            'description' => $date['description'],
        ]);
    }
    

   
}