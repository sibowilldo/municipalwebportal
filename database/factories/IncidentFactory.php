<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

$factory->define(App\Incident::class, function (Faker $faker) {

    $types = App\Type::pluck('id')->toArray();
    $statuses = App\Status::where('model_type', 'App\Incident')->pluck('id')->toArray();
    $WeekAgo = Carbon::now()->subWeek();

    return [
        'uuid' => Uuid::uuid4()->getBytes(),
        'reference' => Carbon::now()->timestamp,
        'name' => $faker->randomElement($array = array ('Burst Water Pipe','Sinkhole','Electric Wire on the road', 'Smoke Coming from Substation', 'Uncovered Manhole', 'Collapse Street Pole')),
        'description' => $faker->realtext(70, 2),
        'location_description' => $faker->address.' '. $faker->realtext(20, 2) ,
        'latitude' => $faker->latitude($min = -90, $max = 90),
        'longitude' => $faker->longitude($min = -180, $max = 180),
        'suburb_id' => $faker->numberBetween(1, 9),
        'type_id' => $faker->randomElement($array = $types),
        'status_id' =>  $faker->randomElement($array = $statuses),
        'created_at' => $WeekAgo->addDay(random_int(1,14)),
        'updated_at' => $WeekAgo
    ];
});
