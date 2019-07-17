<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement($array = array ('Waste','Electricity','Water', 'Billing', 'Park', 'Road', 'Other')),
        'description' => $faker->text,
        'is_active' => $faker->boolean,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
