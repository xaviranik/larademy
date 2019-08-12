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

        $this->assertEquals(
            $user->numberOfCompletedLessonsInSeries($series), 2
        );
    }

    public function test_user_can_get_percentage_completed_for_a_series()
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

        $lesson3 = factory(Lesson::class)->create([
            'series_id' => $series->id
        ]);

        $lesson4 = factory(Lesson::class)->create([
            'series_id' => $series->id
        ]);

        $user->completeLesson($lesson1);
        $user->completeLesson($lesson2);

        $this->assertEquals(
            $user->percentageCompletedForSeries($series), 50
        );
    
    }

    public function test_a_user_can_start_a_series()
    {
        $this->flushRedis();
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $lesson1 = factory(Lesson::class)->create();

        $lesson2 = factory(Lesson::class)->create();

        $user->completeLesson($lesson1);

        $this->assertTrue($user->hasStartedSeries($lesson1->series));
        $this->assertFalse($user->hasStartedSeries($lesson2->series));
    }
}
