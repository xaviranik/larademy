<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{

    use RefreshDatabase;

    public function test_a_user_can_register()
    {
        $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password'
        ])
            ->assertRedirect('/home');

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe'
        ]);
    }
}
