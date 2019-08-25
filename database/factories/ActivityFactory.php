<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Activity;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(Activity::class, function (Faker $faker) {
    return [
        'title'         => $this->faker->sentence,
        'date_time'     => Carbon::parse('1st January 2000 12:00'),
        'distance'      => $this->faker->randomFloat,
        'duration'      => $this->faker->numberBetween(1000, 500000),
        'elevation'     => $this->faker->numberBetween(0, 5000),
        'description'   => $this->faker->paragraph
    ];
});
