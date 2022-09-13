<?php

namespace Tests\Feature\Api;

use App\Models\Lesson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    use UtilsTrait;

    public function test_make_viewed_if_user_unathenticated()
    {
        $response = $this->postJson('/lesson/viewed');

        $response->assertStatus(401);
    }

    public function test_make_viewed_error_validator()
    {
        $paylod = [];
        $response = $this->postJson('/lesson/viewed',
            [],$this->defaultHeaders()
        );

        $response->assertStatus(422);
    }

    public function test_make_viewed_invalide_lesson()
    {
        $paylod = [
            'lesson_id' => 'fake_lesson'
        ];
        $response = $this->postJson('/lesson/viewed',
            $paylod,
            $this->defaultHeaders()
        );


        $response->assertStatus(422);
    }

    public function test_make_viewed_valide_lesson()
    {
        $lesson = Lesson::factory()->create();
        
        $paylod = [
            'lesson_id' => $lesson->id
        ];
        
        $response = $this->postJson('/lesson/viewed',
            $paylod,
            $this->defaultHeaders()
        );

        $response->assertStatus(200);
    }
}
