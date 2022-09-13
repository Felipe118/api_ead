<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Tests\TestCase;

trait UtilsTrait 
{
    public function createTokenUser()
    {
        $user = User::factory()->create();

        $token = $user->createToken('teste')->plainTextToken;

        return $token;
    }

    public function defaultHeaders()
    {
        return [
            'Authorization' => "Bearer {$this->createTokenUser()}"
        ];
    }
}