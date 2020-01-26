<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
$factory->define(App\Category::class, function (Faker $faker) {
    static $color_count = 1;
    $colors = \App\StateColor::pluck('id');
    static $count = 0;
    $names = array ('Waste','Electricity','Water', 'Billing', 'Park', 'Road', 'Other');

    return [
        'name' => $faker->unique()->randomElement($array= $names),
        'description' => $faker->realtext(50, 2),
        'is_active' => $faker->boolean,
        'state_color_id'=>$faker->randomElement($array = $colors),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
