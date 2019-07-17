<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Type::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement($array = array ('Bin not Collected', 'Illegal Dumping', 'Electricity Outage', 'Faulty Meter', 'Pothole', 'Tree Felling', 'Incorrect Meter Reading')),
        'description' => $faker->text,
        'is_active' => $faker->boolean,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
