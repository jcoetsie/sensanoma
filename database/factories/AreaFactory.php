<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Area::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'address' => $faker->streetAddress,
        'coordinates' => "[" .json_encode(['lat' => $faker->latitude, 'lng' => $faker->longitude]). "]",
    ];
});
