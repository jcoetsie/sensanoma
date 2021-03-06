<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Area::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'address' => $faker->streetAddress,
        'coordinates' => "[{\"lat\": 50.85482399245105, \"lng\": 4.355703592300415},
                           {\"lat\": 50.854556458969704, \"lng\": 4.35632586479187},
                           {\"lat\": 50.85445486357474, \"lng\": 4.355564117431641}]",
    ];
});
