<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Activity;
use App\Run;
use App\User;
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

$factory->state(Activity::class, 'withUser', function (Faker $faker) {
    return [
        'user_id'       => function () {
            return factory(User::class)->create()->getKey();
        }
    ];
});

$factory->state(Activity::class, 'run', function (Faker $faker) {
    return [
        'typeable_id' => function() {
            return factory(Run::class)->create()->getKey();
        },
        'typeable_type' => Run::class
    ];
});
