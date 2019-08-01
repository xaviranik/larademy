<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
        'description' => $faker->paragraph(3),
        'series_id' => function () {
            return factory(\App\Series::class)->create()->id;
        },
        'episode_number' => 50,
        'video_id' => '151390908'
    ];
});
