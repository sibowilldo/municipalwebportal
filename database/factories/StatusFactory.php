<?php

use App\StateColor;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Status::class, function (Faker $faker) {

    $colors = StateColor::pluck('id');
    $statuses = array (
        array('name' => 'Active', 'description'=>$faker->realtext(50, 2), 'model_type' => 'App\User'),
        array('name' => 'Assigned', 'description'=>$faker->realtext(50, 2), 'model_type' => 'App\User'),
        array('name' => 'Trashed', 'description'=>$faker->realtext(50, 2), 'model_type' => 'App\User'),
        array('name' => 'Unverified', 'description'=>'Assigned to a user who has not verified their email address or cellphone number', 'model_type' => 'App\User'),
        array('name' => 'In Progress', 'description'=>$faker->realtext(50, 2), 'model_type' => 'App\Incident'),
        array('name' => 'Completed', 'description'=>$faker->realtext(50, 2), 'model_type' => 'App\Incident'),
        array('name' => 'Escalated', 'description'=>$faker->realtext(50, 2), 'model_type' => 'App\Incident'),
        array('name' => 'Assigned', 'description'=>$faker->realtext(50, 2), 'model_type' => 'App\Incident'),
        array('name' => 'Declined', 'description'=>$faker->realtext(50, 2), 'model_type' => 'App\Incident'),
        array('name' => 'Review', 'description'=>$faker->realtext(50, 2), 'model_type' => 'App\Incident'),
        array('name' => 'Cancelled', 'description'=>$faker->realtext(50, 2), 'model_type' => 'App\Incident'),
        array('name' => 'Duplicate', 'description'=>'Incident flagged as a duplicate due to being reported more than once', 'model_type' => 'App\Incident')
        );

    static $status_count = 0;
    $status = $statuses[$status_count++];

    return [
        'name' => $status['name'],
        'description' => $status['description'],
        'is_active' => true,
        'state_color_id'=>$faker->randomElement($array = $colors),
        'model_type'=>$status['model_type'],
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
