<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Config;
use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function loginAsAdmin()
    {
        $user = factory(User::class)->create();
        Config::push('larademy.administrators', $user->email);
        $this->actingAs($user);
    }
}
