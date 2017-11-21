<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Role::class, function (Faker $faker) {
    return [
        'name' => 'admin',
        'display_name' => 'Administrator',
        'description' => 'Administrator',
    ];
});