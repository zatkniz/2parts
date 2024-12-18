<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'company_id' => App\Company::all()->random(1)->first()->id,
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
        'price_offer' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
        'calories' => $faker->randomNumber(),
        'preperation_time' => $faker->randomNumber(),
        'company_category_id' => App\CompanyCategory::all()->random(1)->first()->id,
        'order' => $faker->randomNumber(),
    ];
});
