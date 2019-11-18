<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'capacity' => $faker->numberBetween(1, 100),
        'created_at' => now()
    ];
});
