<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CompanyCategory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(CompanyCategory::class, function (Faker $faker) {
    return [
        'order' => $faker->randomNumber(),
        'product_category_id' => App\ProductCategory::all()->random(1)->first()->id,
        'company_id' => App\Company::all()->random(1)->first()->id 
    ];
});
