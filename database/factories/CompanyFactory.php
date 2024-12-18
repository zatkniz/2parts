<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Phaza\LaravelPostgis\Geometries\Point;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'address' => $faker->address,
        'po_box' => "17673",
        'state' => "Kallithea",
        'tel' => "2100515100",
        'country_id' => 1,
        'logo' => '/assets/media/users/300_21.jpg',
        // 'location' => new Point($faker->latitude, $faker->longitude),
        'status' => $faker->numberbetween (0,1)
        
    ];
});
