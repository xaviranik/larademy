<?php

namespace Tests\Unit;

use App\Lesson;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Series;

class SeriesTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_series_has_a_valid_image_path()
    {
        $series = factory(Series::class)->create([
            'image_url' => 'series_slug.png'
        ]);

        $imagePath = $series->image_path;
        
        $this->assertEquals(asset('storage/series/series_slug.png'), $imagePath);
    }

    public function test_can_get_ordered_lessons_for_a_series()
    {
        $lesson2 = factory(Lesson::class)->create([
            'episode_number' => 2
        ]);
        $lesson1 = factory(Lesson::class)->create([
            'episode_number' => 1,
            'series_id' => 1
        ]);
        $lesson3 = factory(Lesson::class)->create([
            'episode_number' => 3,
            'series_id' => 1
        ]);

        $lessons = $lesson1->series->getOrderedLessons();

        $this->assertInstanceOf(Lesson::class, $lessons->random());

        $this->assertEquals($lessons->first()->id, $lesson1->id);
        $this->assertEquals($lessons->last()->id, $lesson3->id);
    }
}
