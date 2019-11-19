<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Module;
use Faker\Generator as Faker;

$factory->define(Module::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->numberBetween(10000000, 99999999),
        'created_at' => now()
    ];
});
