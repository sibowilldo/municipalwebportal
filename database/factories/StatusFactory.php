<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Status::class, function (Faker $faker) {
    static $count = 1;
    static $status_count = 0;

    $colors = \App\StateColor::pluck('css_class');
    $statuses = array ('Active','In Progress','Completed', 'Escalated', 'Assigned', 'Cancelled');
    return [
        'name' => $statuses[$status_count++],
        'description' => $faker->realtext(50, 2),
        'is_active' => true,
        'state_color'=>$colors[$count++],
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
