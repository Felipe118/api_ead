<?php

namespace Tests\Feature\Api;

use App\Models\Lesson;
use App\Models\Support;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\UtilsTrait;
use Tests\TestCase;

class SupportTest extends TestCase
{
    use UtilsTrait;

    public function test_get_my_support_unauthenticated()
    {
        $response = $this->getJson('/my-supports');

        $response->assertStatus(401);
    }

    public function test_get_support_and_count_if_only_my_user()
    {
        $user = $this->createuser();


        $token = $user->createToken('teste')->plainTextToken;

        Support::factory()->count(50)->create([
            'user_id' => $user->id
        ]);

        Support::factory()->count(50)->create();

        $response = $this->getJson('/my-supports',['Authorization' => "Bearer {$token}"]);

        $response->assertStatus(200)
                 ->assertJsonCount(50, 'data');

    }

    public function test_get_supports_unauthenticated()
    {
        $response = $this->getJson('/supports');

        $response->assertStatus(401);
    }


    public function test_get_supports_filter_lesson()
    {
        $lesson = Lesson::factory()->create();
        Support::factory()->count(50)->create();
        Support::factory()->count(10)->create(
            [
                'lesson_id' => $lesson->id
            ]
        );

        $payload = [
            'lesson' => $lesson->id
        ];

        $response = $this->json('GET','/supports',$payload,$this->defaultHeaders());
        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    public function test_create_support_unauthenticated()
    {
        $response = $this->postJson('/supports');

        $response->assertStatus(401);
    }

    public function test_create_support_verify_erros_validations_and_verify_messages_erros_validations()
    {
        $response = $this->postJson('/supports', [],$this->defaultHeaders());
        $response->assertJsonPath('errors.lesson.0','The lesson field is required.');
        $response->assertJsonPath('errors.status.0','The status field is required.');
        $response->assertJsonPath('errors.description.0','The description field is required.');
        // dd($response->json());
        $response->assertStatus(422);
    }

    public function test_create_support()
    {
        $lesson = Lesson::factory()->create();
        $payload = [
            'lesson' => $lesson->id,
            'status' => 'P',
            'description' => 'Teste de descrição'
        ];
        $response = $this->postJson('/supports',$payload,$this->defaultHeaders());
       
        $response->assertStatus(201);
    }
} 
