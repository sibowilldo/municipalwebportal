<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Status::class, function (Faker $faker) {
    static $status_count = 0;

    $colors = \App\StateColor::pluck('id');
    $statuses = array ('Active','In Progress','Completed', 'Escalated', 'Assigned', 'Cancelled', 'Trashed', 'Deleted');
    return [
        'name' => $statuses[$status_count++],
        'description' => $faker->realtext(50, 2),
        'is_active' => true,
        'state_color_id'=>$faker->randomElement($array = $colors),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
