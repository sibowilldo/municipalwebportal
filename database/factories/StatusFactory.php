<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Status::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement($array = array ('Active','In Progress','Completed')),
        'description' => $faker->text,
        'is_active' => $faker->boolean,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
