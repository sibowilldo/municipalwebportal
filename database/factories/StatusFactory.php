<?php

use App\StateColor;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Status::class, function (Faker $faker) {

    $colors = StateColor::pluck('id');
    $statuses = array (
        array('name' => 'Active', 'description'=>$faker->realtext(50, 2), 'group' => 'both'),
        array('name' => 'In Progress', 'description'=>$faker->realtext(50, 2), 'group' => 'incidents'),
        array('name' => 'Completed', 'description'=>$faker->realtext(50, 2), 'group' => 'incidents'),
        array('name' => 'Escalated', 'description'=>$faker->realtext(50, 2), 'group' => 'incidents'),
        array('name' => 'Assigned', 'description'=>$faker->realtext(50, 2), 'group' => 'incidents'),
        array('name' => 'Declined', 'description'=>$faker->realtext(50, 2), 'group' => 'incidents'),
        array('name' => 'Review', 'description'=>$faker->realtext(50, 2), 'group' => 'incidents'),
        array('name' => 'Cancelled', 'description'=>$faker->realtext(50, 2), 'group' => 'incidents'),
        array('name' => 'Trashed', 'description'=>$faker->realtext(50, 2), 'group' => 'both'),
        array('name' => 'Deleted', 'description'=>$faker->realtext(50, 2), 'group' => 'both'),
        array('name' => 'Unverified', 'description'=>'Assigned to a user who has not verified their email address or cellphone number', 'group' => 'users'));

    static $status_count = 0;
    $status = $statuses[$status_count++];

    return [
        'name' => $status['name'],
        'description' => $status['description'],
        'group'=>$status['group'],
        'is_active' => true,
        'state_color_id'=>$faker->randomElement($array = $colors),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
