<?php

namespace Tests\Feature;

use App\Lesson;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WatchSeriesTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_user_can_complete_a_series()
    {
        $this->flushRedis();
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);
        $lesson1 = factory(Lesson::class)->create();
        $lesson2 = factory(Lesson::class)->create(['series_id' => 1]);

        $this->post("/series/complete-lesson/{$lesson1->id}", [])
        ->assertStatus(200)
        ->assertJson(['status' => 'ok']);

        $this->assertTrue($user->hasCompletedLesson($lesson1));
        $this->assertFalse($user->hasCompletedLesson($lesson2));
    }
}
