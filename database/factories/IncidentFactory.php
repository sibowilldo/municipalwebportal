<?php

use Faker\Generator as Faker;
use Carbon\Carbon;


$factory->define(App\Incident::class, function (Faker $faker) {
    return [
        'reference' => Carbon::now()->timestamp,
        'name' => $faker->randomElement($array = array ('Burst Water Pipe','Sinkhole','Electric Wire on the road')),
        'description' => $faker->text,
        'location_description' => $faker->text,
        'latitude' => $faker->latitude($min = -90, $max = 90),
        'longitude' => $faker->longitude($min = -180, $max = 180),
        'suburb_id' => $faker->numberBetween(1, 9),
        'type_id' => $faker->numberBetween(1, 5),
        'status_id' => $faker->numberBetween(1, 5),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
