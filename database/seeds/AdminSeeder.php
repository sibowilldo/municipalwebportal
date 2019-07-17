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
            'firstname' => 'Sibongiseni',
            'lastname' => 'Msomi',
            'contactnumber' => '0718900884',
            'email' => 'msomis@gmail.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'activation_token' => '',
            'last_loggedin_at' => null,
            'password' => bcrypt('admin123'), // secret
            'remember_token' => str_random(10),
            'status_is' => $faker->randomElement($array = array ('active', 'assigned', 'available', 'blocked', 'inactive','trashed', 'unverified')),
            'created_at' => \Carbon\Carbon::now()->subDays(random_int(10,15)),
            'updated_at' => null,
            'deleted_at' => null]);

        $user->roles()->attach([3]);
    }
}
