<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CreateSeriesTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_a_series()
    {
        $this->withoutExceptionHandling();

        Storage::fake(config('filesystems.default'));

        $title = 'Test Title';

        $this->post('/admin/series', [
            'title' => $title,
            'description' => "Test Description",
            'image' => UploadedFile::fake()->image('test-image.png')
        ])->assertRedirect();

        Storage::disk(config('filesystems.default'))->assertExists('series/' . str_slug($title) . '.png');

        $this->assertDatabaseHas('series', [
            'slug' => str_slug($title)
        ]);
    }
}
