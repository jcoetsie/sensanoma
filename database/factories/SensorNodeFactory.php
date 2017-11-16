<?php

use Faker\Generator as Faker;

$factory->define(App\Models\SensorNode::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'type' => 'B-Sprouts v1'
    ];
});
