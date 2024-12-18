<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CompanyUser;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(CompanyUser::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random(1)->first()->id,
        'company_id' => App\Company::all()->random(1)->first()->id 
    ];
});
