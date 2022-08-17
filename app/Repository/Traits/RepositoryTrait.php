<?php
    namespace App\Repository\Traits;

use App\Models\User;

    Trait RepositoryTrait
    {
        public function getUserAuth() :User
        {
            return User::first();
        }
    }