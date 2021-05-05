<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Role;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    $gender = $faker->numberBetween(0,2);
    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'first_name_ruby' => $faker->firstKanaName($gender),
        'last_name_ruby' => $faker->lastKanaName($gender),
        'email' => $faker->safeEmail(),
        'email_verified_at' => null,
        'password' => \Hash::make('test1234'),
        'role_id' => Role::where('role_id', 5)->first()->id,
        'postal_code' => $faker->postcode(),
        'gender' => $gender,
        'birthday' => $faker->dateTimeBetween('-80 years', '-20years')->format('Y-m-d'),
        'pref_id' => $faker->numberBetween(0,47),
        'city' => $faker->city(),
        'block' => $faker->streetAddress(),
        'building' => $faker->secondaryAddress(),
        'phone_number' => $faker->phoneNumber(),
    ];
});
