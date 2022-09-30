<?php

namespace Tests\Feature\Api;

use App\Models\Support;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReplySupportTest extends TestCase
{
    use UtilsTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_create_reply_support_unauthenticated()
    {
        $response = $this->postJson('/replies');

        $response->assertStatus(401);
    }

    public function test_create_reply_support_authenticated_and_without_data()
    {
        $response = $this->postJson('/replies',[],$this->defaultHeaders());

        $response->assertStatus(422);
    }

    public function test_validations_replies()
    {
        $response = $this->postJson('/replies',[],$this->defaultHeaders());

        $response->assertJsonValidationErrors(['support','description']);
    }


    public function test_create_new_reply_support()
    {
        $support = Support::factory()->create();
        $payload = [ 
            'description' => 'Teste de descrição',
            'support' => $support->id
        ];
        $response = $this->postJson('/replies',$payload,$this->defaultHeaders());

        $response->assertStatus(201);
    }
}
