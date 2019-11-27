<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $statuses = \App\Status::pluck('id');

        $sah = \App\User::create([
            'uuid' => $faker->uuid,
            'firstname' => 'Sandile',
            'lastname' => 'Ndimande',
            'contactnumber' => '0711234567',
            'email' => 'maskinasah@gmail.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'activation_token' => '',
            'last_loggedin_at' => null,
            'password' => bcrypt('admin123'), // secret
            'remember_token' => str_random(10),
            'status_id' => $faker->randomElement($array = $statuses),
            'created_at' => \Carbon\Carbon::now()->subDays(random_int(10,15)),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => null]);
        $luh = \App\User::create([
            'uuid' => $faker->uuid,
            'firstname' => 'Lungisani',
            'lastname' => 'Blose',
            'contactnumber' => '082765321',
            'email' => 'phoyane@gmail.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'activation_token' => '',
            'last_loggedin_at' => null,
            'password' => bcrypt('admin123'), // secret
            'remember_token' => str_random(10),
            'status_id' => $faker->randomElement($array = $statuses),
            'created_at' => \Carbon\Carbon::now()->subDays(random_int(10,15)),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => null]);
        $sbo = \App\User::create([
            'uuid' => $faker->uuid,
            'firstname' => 'Sibongiseni',
            'lastname' => 'Msomi',
            'contactnumber' => '0718900884',
            'email' => 'msomis@gmail.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'activation_token' => '',
            'last_loggedin_at' => null,
            'password' => bcrypt('admin123'), // secret
            'remember_token' => str_random(10),
            'status_id' => $faker->randomElement($array = $statuses),
            'created_at' => \Carbon\Carbon::now()->subDays(random_int(10,15)),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => null]);
        $oye = \App\User::create([
            'uuid' => $faker->uuid,
            'firstname' => 'Oye',
            'lastname' => 'Oridota',
            'contactnumber' => '0831234567',
            'email' => 'oridotaoyebode@gmail.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'activation_token' => '',
            'last_loggedin_at' => null,
            'password' => bcrypt('admin123'), // secret
            'remember_token' => str_random(10),
            'status_id' => $faker->randomElement($array = $statuses),
            'created_at' => \Carbon\Carbon::now()->subDays(random_int(10,15)),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => null]);
        $zeh = \App\User::create([
            'uuid' => $faker->uuid,
            'firstname' => 'Zethembiso',
            'lastname' => 'Msomi',
            'contactnumber' => '0831234567',
            'email' => 'zethembiso.msomi@gmail.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'activation_token' => '',
            'last_loggedin_at' => null,
            'password' => bcrypt('admin123'), // secret
            'remember_token' => str_random(10),
            'status_id' => $faker->randomElement($array = $statuses),
            'created_at' => \Carbon\Carbon::now()->subDays(random_int(10,15)),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => null]);
        $jev = \App\User::create([
            'uuid' => $faker->uuid,
            'firstname' => 'Jevon',
            'lastname' => 'Bhagaloo',
            'contactnumber' => '0831234567',
            'email' => 'jevonbhagaloo09@gmail.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'activation_token' => '',
            'last_loggedin_at' => null,
            'password' => bcrypt('admin123'), // secret
            'remember_token' => str_random(10),
            'status_id' => $faker->randomElement($array = $statuses),
            'created_at' => \Carbon\Carbon::now()->subDays(random_int(10,15)),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => null]);

        $sah->roles()->attach([4]);
        $luh->roles()->attach([4]);
        $sbo->roles()->attach([4]);
        $oye->roles()->attach([4]);
        $zeh->roles()->attach([4]);
        $jev->roles()->attach([4]);
    }
}
