<?php

namespace Tests\Unit;

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
}
