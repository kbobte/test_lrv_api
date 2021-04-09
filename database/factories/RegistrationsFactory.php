<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Registration;
use Faker\Generator as Faker;

$factory->define(Registration::class, function (Faker $faker) {
    $date = $faker->dateTimeThisYear();
    return [
        'name' => $faker->firstName(),
        'email' => $faker->unique()->safeEmail,
        'age' => random_int(18, 70),
        'status' => $faker->randomElement(['in progress', 'canceled', 'other']),
        'locked' => $faker->randomElement([false, true]),
        'egn' => '85' . (string) $faker->unique()->randomNumber(8),
        'created_at' => $date,
        'updated_at' => $date,
    ];
});
