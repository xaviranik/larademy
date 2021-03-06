<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Series;
use Faker\Generator as Faker;

$factory->define(Series::class, function (Faker $faker) {
    $title = $faker->sentence(8);
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'image_url' => $faker->imageUrl(),
        'description' => $faker->paragraph()

    ];
});
