<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Series;
use App\Lesson;
use Illuminate\Support\Facades\Redis;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_user_can_complete_a_lesson()
    {
        $this->flushRedis();
        $user = factory(User::class)->create();
        $series = factory(Series::class)->create();

        $lesson1 = factory(Lesson::class)->create([
            'series_id' => $series->id
        ]);

        $lesson2 = factory(Lesson::class)->create([
            'series_id' => $series->id
        ]);

        $user->completeLesson($lesson1);
        $user->completeLesson($lesson2);

        $this->assertEquals(
            Redis::smembers("user:1:series:1"), [1, 2]
        );
    }
}
