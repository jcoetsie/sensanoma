<?php

use Faker\Generator as Faker;

$factory->define(App\Models\SensorNode::class, function (Faker $faker) {
    return [
        'name' => 'b000',
        'type' => 'B-sprout'
    ];
});
