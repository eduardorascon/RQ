<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Breed::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->string
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {    

    return [
        'first_name' => $faker->string,
        'last_name' => $faker->string,
        'address' => $faker->string,
        'company' => $faker->string,
        'phone' => $faker->string
    ];
});
