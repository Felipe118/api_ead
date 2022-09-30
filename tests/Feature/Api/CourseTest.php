<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{ 
    use UtilsTrait;

    public function test_unauthenticated()
    {
    //    $token = $this->createTokenUser();

        $response = $this->getJson('/courses');

        $response->assertStatus(401);
    }

   

    public function test_if_courses_is_authorized()
    {

        $response = $this->getJson('/courses', $this->defaultHeaders());

        $response->assertStatus(200);
    }

    public function test_the_total_number_courses()
    {
       $courses = Course::factory()->count(10)->create();

       $response = $this->getJson('/courses', $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(count($courses), 'data');
    }

    public function test_get_single_course_not_found()
    {
        $response = $this->getJson('/courses/fake_id', $this->defaultHeaders());

        $response->assertStatus(404);
    }

    public function test_get_single_course()
    {
        $courses = Course::factory()->create();


        $response = $this->getJson("/courses/{$courses->id}", $this->defaultHeaders());

        $response->assertStatus(200);
    }
}
