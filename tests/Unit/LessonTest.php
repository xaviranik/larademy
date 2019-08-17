<?php

namespace Tests\Unit;

use App\Lesson;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_get_next_and_previous_lesson()
    {
        $lesson1 = factory(Lesson::class)->create([
            'episode_number' => 1
        ]);
        $lesson2 = factory(Lesson::class)->create([
            'episode_number' => 2,
            'series_id' => 1
        ]);
        $lesson3 = factory(Lesson::class)->create([
            'episode_number' => 3,
            'series_id' => 1
        ]);

        $this->assertEquals($lesson1->getNextLesson()->id, $lesson2->id);
        $this->assertEquals($lesson2->getPreviousLesson()->id, $lesson1->id);
        $this->assertEquals($lesson3->getPreviousLesson()->id, $lesson2->id);
        $this->assertEquals($lesson1->getPreviousLesson()->id, $lesson1->id);
        $this->assertEquals($lesson3->getNextLesson()->id, $lesson3->id);
        
    }
}
