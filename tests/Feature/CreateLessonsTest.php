<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Series;

class CreateLessonsTest extends TestCase
{
    use RefreshDatabase;
    public function test_an_admin_can_create_a_lesson()
    {
        $this->loginAsAdmin();
        $series = factory(Series::class)->create();
        $series = $series->fresh();
        $lesson = [
            'title' => 'Test Lesson Title',
            'description' => 'test description',
            'episode_number' => 1,
            'video_id' => 1234
        ];

        $this->postJson("/admin/{$series->id}/lessons", $lesson)
        ->assertStatus(201)
        ->assertJson($lesson);

        $this->assertDatabaseHas('lessons', [
            'title' => $lesson['title']
        ]);
    }
    
    public function test_a_title_is_required_to_create_a_test()
    {
        $this->loginAsAdmin();
        $series = factory(Series::class)->create();
        $series = $series->fresh();
        $lesson = [
            'description' => 'test description',
            'episode_number' => 1,
            'video_id' => 1234
        ];

        $this->post("/admin/{$series->id}/lessons", $lesson)
            ->assertSessionHasErrors('title');
    }

    public function test_a_decription_is_required_to_create_a_test()
    {
        $this->loginAsAdmin();
        $series = factory(Series::class)->create();
        $series = $series->fresh();
        $lesson = [
            'title' => 'test title',
            'episode_number' => 1,
            'video_id' => 1234
        ];

        $this->post("/admin/{$series->id}/lessons", $lesson)
            ->assertSessionHasErrors('description');
    }

    public function test_a_episode_number_is_required_to_create_a_test()
    {
        $this->loginAsAdmin();
        $series = factory(Series::class)->create();
        $series = $series->fresh();
        $lesson = [
            'title' => 'test title',
            'description' => 'test description',
            'video_id' => 1234
        ];

        $this->post("/admin/{$series->id}/lessons", $lesson)
            ->assertSessionHasErrors('episode_number');
    }

    public function test_a_video_id_is_required_to_create_a_test()
    {
        $this->loginAsAdmin();
        $series = factory(Series::class)->create();
        $series = $series->fresh();
        $lesson = [
            'title' => 'test title',
            'description' => 'test description',
            'episode_number' => 1
        ];

        $this->post("/admin/{$series->id}/lessons", $lesson)
            ->assertSessionHasErrors('video_id');
    }
}
