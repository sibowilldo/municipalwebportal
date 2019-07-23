<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::where('name', '!=', 'super-administrator')->pluck('id');

        factory(App\User::class,50)->create()->each(function ($user){
            // Seed the relation with 5 purchases
            $incidents = factory(App\Incident::class, 2)->make();
            $user->incidents()->saveMany($incidents);
        });

        App\User::All()->each(function ($user) use ($roles){
            $user->roles()->attach(Faker::create()->randomElement($array = $roles));
        });
    }
}
