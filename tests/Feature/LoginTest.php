<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_correct_response_after_user_logs_in()
    {
        $user = factory('App\User')->create();
        $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'password'
        ])
            ->assertStatus(200)
            ->assertJson([
                'status' => 'ok'
            ])
            ->assertSessionHas('success', 'Successfully logged in');
    }

    public function test_a_user_receive_feedback_when_passing_in_wrong_credentials()
    {
        $user = factory('App\User')->create();
        $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'wrong-password'
        ])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'These credentials do not match our records.'
            ]);
    }
}
