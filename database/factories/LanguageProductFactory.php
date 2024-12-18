<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LanguageProduct;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(LanguageProduct::class, function (Faker $faker) {
    return [
        'language_id' => App\Language::all()->random(1)->first()->id,
        'product_id' => App\Product::all()->random(1)->first()->id 
    ];
});
