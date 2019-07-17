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
        $user = \App\User::create([
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
            'status_is' => 'active',
            'created_at' => \Carbon\Carbon::now()->subDays(random_int(10,15)),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => null]);

        $user->roles()->attach([3]);

        $user = \App\User::create([
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
            'status_is' => 'active',
            'created_at' => \Carbon\Carbon::now()->subDays(random_int(10,15)),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => null]);

        $user->roles()->attach([3]);

        $user = \App\User::create([
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
            'status_is' => 'active',
            'created_at' => \Carbon\Carbon::now()->subDays(random_int(10,15)),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => null]);

        $user->roles()->attach([3]);
    }
}
