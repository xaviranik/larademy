<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

class CreateSeriesTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_a_series()
    {
        Storage::fake(config('filesystems.default'));

        $this->loginAsAdmin();

        $title = 'Test Title';

        $this->post('/admin/series', [
            'title' => $title,
            'description' => "Test Description",
            'image' => UploadedFile::fake()->image('test-image.png')
        ])->assertRedirect()
            ->assertSessionHas('success', 'Series created successfully');

        Storage::disk(config('filesystems.default'))->assertExists('public/series/' . str_slug($title) . '.png');

        $this->assertDatabaseHas('series', [
            'slug' => str_slug($title)
        ]);
    }

    public function test_a_series_must_have_a_title()
    {
        $this->loginAsAdmin();

        $this->post('/admin/series', [
            'description' => "Test Description",
            'image' => UploadedFile::fake()->image('test-image.png')
        ])->assertSessionHasErrors('title');
    }

    public function test_a_series_must_have_a_description()
    {
        $this->loginAsAdmin();

        $this->post('/admin/series', [
            'title' => "Test Title",
            'image' => UploadedFile::fake()->image('test-image.png')
        ])->assertSessionHasErrors('description');
    }

    public function test_a_series_must_have_an_image()
    {

        $this->loginAsAdmin();

        $this->post('/admin/series', [
            'title' => "Test Title",
            'description' => 'Test Description'
        ])->assertSessionHasErrors('image');
    }

    public function test_uploaded_image_must_be_a_valid_image()
    {

        $this->loginAsAdmin();

        $this->post('/admin/series', [
            'title' => "Test Title",
            'description' => 'Test Description',
            'image' => 'invalid-image'
        ])->assertSessionHasErrors('image');
    }

    public function test_only_admin_can_create_series()
    {
        $this->actingAs(factory('App\User')->create());
        $this->post('admin/series')->assertSessionHas('error', 'Unauthorized access')
        ->assertRedirect('/');
    }
}
