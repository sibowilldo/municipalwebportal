<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'contactnumber' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => \Carbon\Carbon::now(),
        'activation_token' => '',
        'last_loggedin_at' => null,
        'password' => bcrypt('secret'), // secret
        'remember_token' => str_random(10),
        'status_is' => 'active',
        'created_at' => \Carbon\Carbon::now()->subDays(random_int(10,15)),
        'updated_at' => null,
        'deleted_at' => \Carbon\Carbon::now()->subDays(random_int(1,5)),
    ];
});
