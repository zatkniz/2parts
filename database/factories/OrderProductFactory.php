
<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderProduct;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(OrderProduct::class, function (Faker $faker) {
    return [
        'product_id' => App\Product::all()->random(1)->first()->id,
        'order_id' => App\Order::all()->random(1)->first()->id 
    ];
});
