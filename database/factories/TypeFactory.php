<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Type::class, function (Faker $faker) {
    static $count = 1;
    $colors = \App\StateColor::pluck('id');
    return [
        'name' => $faker->unique()->randomElement($array = array ('Bin not Collected', 'Illegal Dumping', 'Electricity Outage', 'Faulty Meter', 'Pothole', 'Tree Felling', 'Incorrect Meter Reading')),
        'description' => $faker->realtext(50, 2),
        'is_active' => $faker->boolean,
        'state_color_id'=>$faker->randomElement($array = $colors),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
