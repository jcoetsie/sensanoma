<?php

use Faker\Generator as Faker;


$factory->define(App\Models\Zone::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'crop' => $faker->word,
        'coordinates' => "[" .json_encode(['lat' => $faker->latitude, 'lng' => $faker->longitude]). "]",
    ];
});
