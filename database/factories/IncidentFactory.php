<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Incident::class, function (Faker $faker) {

    $types = App\Type::pluck('id')->toArray();
    $statuses = App\Status::pluck('id')->toArray();

    return [
        'uuid' => $faker->uuid,
        'reference' => Carbon::now()->timestamp,
        'name' => $faker->randomElement($array = array ('Burst Water Pipe','Sinkhole','Electric Wire on the road', 'Smoke Coming from Substation', 'Open Manhole', 'Collapse Street Pole')),
        'description' => $faker->text,
        'location_description' => $faker->text,
        'latitude' => $faker->latitude($min = -90, $max = 90),
        'longitude' => $faker->longitude($min = -180, $max = 180),
        'suburb_id' => $faker->numberBetween(1, 9),
        'type_id' => random_int(1, count($types)),
        'status_id' => random_int(1, count($statuses)),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
