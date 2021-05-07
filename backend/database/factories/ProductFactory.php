<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\User;
use App\Models\OrderStatus;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(1),
        'price' => $faker->numberBetween(1000,10000),
        'stock' => $faker->numberBetween(0,10000),
        'description' => $faker->sentence(),
        'image' => $faker->imageUrl(),
    ];
});
