<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CompanyCategoryLanguage;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(CompanyCategoryLanguage::class, function (Faker $faker) {
    return [
        'company_category_id' => App\CompannyCategory::all()->random(1)->first()->id,
        'language_id' => App\Language::all()->random(1)->first()->id 
    ];
});
