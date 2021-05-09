<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use App\Models\User;
use App\Models\OrderStatus;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'price' => $faker->numberBetween(1000,10000),
        'order_status_id' => OrderStatus::find(1)->id,
    ];
});
