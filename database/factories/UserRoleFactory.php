<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserRole;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(UserRole::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
