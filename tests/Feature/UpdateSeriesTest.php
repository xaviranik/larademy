<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Series;

class UpdateSeriesTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_user_can_update_a_series()
    {
        $this->withoutExceptionHandling();
        Storage::fake(config('filesystems.default'));

        $this->loginAsAdmin();

        $series = factory(Series::class)->create();

        $this->put(route('series.update', $series->slug), [
            'title' => 'New Series',
            'description' => 'New description',
            'image' => UploadedFile::fake()->image('test-image.png')
        ])->assertRedirect(route('series.index'))
        ->assertSessionHas('success', 'Successfully updated series');

        Storage::disk(config('filesystems.default'))->assertExists('public/series/' . str_slug('New Series') . '.png');

        $this->assertDatabaseHas('series', [
            'slug' => str_slug('New Series')
        ]);
    }
}
