<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Click::class, function (Faker\Generator $faker) {
    return [
        'bad_domain' => $faker->randomElement([0, 1]),
        'error'      => $faker->randomDigit,
        'ip'         => $faker->ipv4,
        'param1'     => $faker->word,
        'param2'     => $faker->word,
        'ref'        => $faker->url,
        'ua'         => $faker->userAgent,
    ];
});
