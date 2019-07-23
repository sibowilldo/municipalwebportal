<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Type::class, function (Faker $faker) {
    static $count = 1;
    $colors = \App\StateColor::pluck('css_class');
    return [
        'name' => $faker->randomElement($array = array ('Bin not Collected', 'Illegal Dumping', 'Electricity Outage', 'Faulty Meter', 'Pothole', 'Tree Felling', 'Incorrect Meter Reading')),
        'description' => $faker->realtext(50, 2),
        'is_active' => $faker->boolean,
        'state_color'=>$colors[$count++],
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
